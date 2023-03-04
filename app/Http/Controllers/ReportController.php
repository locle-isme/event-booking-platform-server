<?php

namespace App\Http\Controllers;

use App\Models\Event;

class ReportController extends Controller
{
    public function index(Event $event)
    {
        $event->sessions = $event->rooms->map(function ($room) {
            return $room->sessions->map(function ($session) use ($room) {
                $session->start = date('H:i', strtotime($session->start));
                $session->end = date('H:i', strtotime($session->end));
                $session->capacity = $room->capacity;
                if ($session->type == "talk") {
                    $session->attendee = $room->channel->event->registrations->count();
                } else {
                    $session->attendee = $session->sessionRegistrations->count();
                }
                return ($session)->only('title', 'start', 'date', 'capacity', 'attendee');
            });
        })->collapse()->sortBy('start')->values();
        return view('reports.index', compact('event'));
    }
}
