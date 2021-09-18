<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use App\Event;
use App\Http\Resources\Event\EventDetailRS;
use App\Http\Resources\Event\EventOverviewRS;
use App\Http\Resources\Event\EventRegistrationRS;
use App\Organizer;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventManagement extends Controller
{
    public function index()
    {
        $events = Event::whereRaw('date > CURDATE()')->where('active', 1)->orderBy('date')->get();
        return response()->json(['events' => EventOverviewRS::collection($events)]);
    }

    public function detail($oslug, $eslug)
    {
        $organizer = Organizer::where('slug', $oslug)->first();
        if (!$organizer) {
            return response()->json(['message' => 'Organizer not found'], 404);
        }
        $event = $organizer->events->where('slug', $eslug)->first();
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        if (!$event->active) {
            return response()->json(['message' => 'Event not ready'], 419);
        }
        return response()->json(new EventDetailRS($event));
    }

    public function registration(Request $request)
    {
        $attendee = Attendee::where(['login_token' => $request->token])->first();
        if (!$attendee) {
            return response()->json(['message' => 'User not logged in'], 401);
        }
        $ticket = Ticket::find($request->ticket_id);
        if (!$ticket || !$ticket->isAvailable() || !$ticket->event->isAvailable()) {
            return response()->json(['message' => 'Ticket is no longer available'], 401);
        }
        $isRegistered = $ticket->event->registrations->where('attendee_id', $attendee->id)->count();
        if ($isRegistered > 0) {
            return response()->json(['message' => 'User already registered'], 401);
        }
        $registration = $ticket->registrations()->create([
            'attendee_id' => $attendee->id,
            'registration_time' => date('Y-m-d H:i:s')
        ]);
        if (is_array($sessions = $request->session_ids)) {
            foreach ($sessions as $session_id) {
                $registration->sessionRegistrations()->create([
                    'session_id' => $session_id
                ]);
            }
        }
        return response()->json(['message' => 'Registration successful']);
    }

    public function getRegistrations(Request $request)
    {
        $attendee = Attendee::where(['login_token' => $request->token])->first();
        if (!$attendee) {
            return response()->json(['message' => 'User not logged in'], 401);
        }
        return response()->json(['registrations' => EventRegistrationRS::collection($attendee->registrations)]);
    }
}
