<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Session;
use App\SessionSpeaker;
use App\Speaker;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        //
        $speakers = Speaker::all();
        return view('sessions.create', compact('event', 'speakers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, CreateSessionRequest $request)
    {
        //
        $data = $request->validated();
        $room = $event->rooms->where('id', $data['room'])->first();
        if (!$room) {
            return redirect()->back()->withInput()->withErrors(['room' => 'Room invalid']);
        }

        //check room available
        $isRoomAvailable = $room->sessions->every(function ($s) use ($data) {
            return $data['end'] < $s['start'] || $data['start'] > $s['end'];
        });

        if (!$isRoomAvailable) {
            return redirect()->back()->withInput()->withErrors(['room' => 'Room Room already booked during this time']);
        }


        $speakers = $data['speakers'];
        unset($data['room'], $data['speakers']);
        $session = $room->sessions()->create($data);
        foreach ($speakers as $speaker) {
            $session->sessionSpeakers()->create(
                ['speaker_id' => $speaker]
            );
        }
        return redirect()->route('events.show', $event)->with('message', 'Session successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Session $session)
    {
        //
        $session->start = date('Y-m-d H:i', strtotime($session->start));
        $session->end = date('Y-m-d H:i', strtotime($session->end));
        $speakers = Speaker::all();
        $session->sessionSpeakers = $session->sessionSpeakers->map(function ($sessionSpeaker) {
            return $sessionSpeaker->speaker_id;
        })->toArray();
        //dd($session->sessionSpeakers);
        return view('sessions.edit', compact('event', 'session', 'speakers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, Event $event, Session $session)
    {

        $data = $request->validated();
        $room = $event->rooms->where('id', $data['room'])->first();
        if (!$room) {
            return redirect()->back()->withInput()->withErrors(['room' => 'Room invalid']);
        }

        $isRoomAvailable = $room->sessions->every(function ($s) use ($data, $session) {
            return ($data['end'] < $s['start'] || $data['start'] > $s['end']) || $session['id'] == $s['id'];
        });

        if (!$isRoomAvailable) {
            return redirect()->back()->withInput()->withErrors(['room' => 'Room Room already booked during this time']);
        }

        $data['room_id'] = $data['room'];
        $speakers = $data['speakers'];
        unset($data['room'], $data['speakers']);
        $session->update($data);

        //remove all old records of session speakers
        foreach ($session->sessionSpeakers as $sessionSpeaker) {
            $sessionSpeaker->delete();
        }

        //add new records into session speakers
        foreach ($speakers as $speaker) {
            $session->sessionSpeakers()->create(
                ['speaker_id' => $speaker]
            );
        }

        return redirect()->route('events.show', $event)->with('message', 'Session successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
