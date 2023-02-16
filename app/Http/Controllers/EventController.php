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
        return view('events.index', [
            'events' => $events,
        ]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $event = Auth::user()->events()->create($validated);
        $active = $request->input('active');
        $isActive = $active ? 1 : 0;
        $validated['active'] = $isActive;
        return redirect()->route('events.show', $event)->with('message', 'Event successfully created');
    }

    public function show(Event $event)
    {
        return view('events.detail', [
            'event' => $event,
        ]);
    }

    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event,
        ]);
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $validated = $request->validated();
        $active = $request->input('active');
        $isActive = $active ? 1 : 0;
        $validated['active'] = $isActive;
        $isExist = $event->registrations()->count();
        if ($isExist && $validated['active'] == 0) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }
        $event->update($validated);
        return redirect()->route('events.show', $event)->with('message', 'Event successfully updated');
    }

    public function destroy(Event $event)
    {
        $isAlready = Event::isAlready($event);
        if ($isAlready) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }
        $event->delete();
        return redirect()->route('events.index')->with('message', 'Event successfully deleted');
    }
}
