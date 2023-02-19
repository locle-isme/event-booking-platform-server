<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use App\Event;
use App\Http\Resources\Event\EventDetailRS;
use App\Http\Resources\Event\EventOverviewRS;
use App\Http\Resources\Event\EventRegistrationRS;
use App\Organizer;
use App\Registration;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventManagementController extends ApiController
{
    public function index()
    {
        $events = Event::query()
            ->whereRaw('date > CURDATE()')
            ->where('active', 1)
            ->orderBy('date')
            ->paginate(10);
        EventOverviewRS::collection($events);
        return response()->json($events);
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
        return response()->json(new EventDetailRS($event));
    }

    public function registration(Request $request)
    {
        $attendee = $this->auth->user();
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

    public function getRegistrations()
    {
        $attendee = $this->auth->user();
        if (!$attendee) {
            return response()->json(['message' => 'User not logged in'], 401);
        }
        $registrations = Registration::query()
            ->where('attendee_id', $attendee['id'])
            ->paginate(10);
        EventRegistrationRS::collection($registrations);
        return response()->json($registrations);
    }
}
