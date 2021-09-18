<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Auth::user()->events->sortByDesc('date');
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $request->active == null ? 0 : 1;
        $event = Auth::user()->events()->create($validated);
        return redirect()->route('events.show', $event)->with('message', 'Event successfully created');
    }

    public function show(Event $event)
    {
        $event->sessions = $event->rooms->map(function ($room) {
            return $room->sessions->map(function ($session) use ($room) {
                $session->channel_room = $room->channel->name . ' / ' . $room->name;
                $session->start = date('H:i', strtotime($session->start));
                $session->end = date('H:i', strtotime($session->end));
                $speakers = $session->sessionSpeakers->map(function ($sessionSpeaker) {
                    return $sessionSpeaker->speaker->name;
                })->toArray();
                $session->speakers = implode(", ", $speakers);
                return $session;
            });
        })->collapse()->sortBy('start')->values();

        return view('events.detail', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $validated = $request->validated();
        $validated['active'] = $request->active == null ? 0 : 1;
        $isExist = $event->registrations()->count();
        if ($isExist && $validated['active'] == 0) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }
        $event->update($validated);
        return redirect()->route('events.show', $event)->with('message', 'Event successfully updated');
    }

    public function destroy(Event $event)
    {
        $isExist1 = $event->tickets()->count();
        $isExist2 = $event->channels()->count();
        if ($isExist1 || $isExist2) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }
        $event->delete();
        return redirect()->route('events.index')->with('message', 'Event successfully deleted');
    }
}
