<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = Auth::user()->events->sortByDesc('date');
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $validated = $request->validated();
        $validated['active'] = $request->active == null ? 0 : 1;
        $event = Auth::user()->events()->create($request->validated());
        return redirect()->route('events.show', $event)->with('message', 'Event successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        $event->sessions = $event->rooms->map(function ($room) {
            return $room->sessions->map(function ($session) use ($room) {
                $session->channel_room = $room->channel->name . ' / ' . $room->name;
                $session->start = date('H:i', strtotime($session->start));
                $session->end = date('H:i', strtotime($session->end));
                $speakers = $session->sessionSpeakers->map(function ($sessionSpeaker) {
                    return $sessionSpeaker->speaker->name;
                })->toArray();
                //dd($session->speakers);
                $session->speakers = implode(", ", $speakers);
                return $session;
            });
        })->collapse()->sortBy('start')->values();

        return view('events.detail', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        //dd($event);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
        $validated = $request->validated();
        $validated['active'] = $request->active == null ? 0 : 1;
        $isExist = $event->registrations()->count();
        if ($isExist && $validated['active'] == 0) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }
        $event->update($validated);
        return redirect()->route('events.show', $event)->with('message', 'Event successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        $isExist1 = $event->tickets()->count();
        $isExist2 = $event->channels()->count();
        //dd($isExist1, $isExist2);
        if ($isExist1 && $isExist2) {
            return redirect()->route('events.show', $event)->with('error-message', 'This event is used');
        }

        $event->delete();
        return redirect()->route('events.index')->with('message', 'Event successfully deleted');

    }
}
