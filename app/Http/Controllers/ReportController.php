<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Event $event)
    {
        $event->sessions = $event->rooms->map(function ($room) {
            return $room->sessions->map(function ($session) use ($room) {
                $session->start = date('H:i', strtotime($session->start));
                $session->end = date('H:i', strtotime($session->end));
                $session->capacity = $room->capacity;
                if ($session->type == 'talk') {
                    $session->attendee = $room->channel->event->registrations->count();
                } else {
                    $session->attendee = $session->sessionRegistrations->count();
                }
                return collect($session)->only('title', 'start', 'end', 'capacity', 'attendee');
            });
        })->collapse()->sortBy('start')->values();
        //dd($event->sessions);
        return view('reports.index', compact('event'));
    }
}
