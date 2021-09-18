<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\Session\StoreRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Session;
use App\SessionSpeaker;
use App\Speaker;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(Event $event)
    {
        $speakers = Speaker::all();
        $newListSpeakers = [];
        foreach ($speakers as $speaker) {
            $newListSpeakers[$speaker->id] = $speaker->name;
        }
        $speakers = $newListSpeakers;
        $rooms = [];
        foreach ($event->rooms as $room) {
            $rooms[$room->id] = $room->channel->name . ' / ' . $room->name;
        }
        return view('sessions.create', compact('event', 'speakers', 'rooms'));
    }

    public function store(StoreRequest $request, Event $event)
    {
        $data = $request->validated();
        $room = $event->rooms->where('id', $data['room'])->first();
        if (!$room) {
            return redirect()->back()->withInput()->withErrors(['room' => 'Room invalid']);
        }

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

    public function edit(Event $event, Session $session)
    {
        $session->start = date('Y-m-d H:i', strtotime($session->start));
        $session->end = date('Y-m-d H:i', strtotime($session->end));
        $speakers = Speaker::all();
        $newListSpeakers = [];
        foreach ($speakers as $speaker) {
            $newListSpeakers[$speaker->id] = $speaker->name;
        }
        $speakers = $newListSpeakers;
        $rooms = [];
        foreach ($event->rooms as $room) {
            $rooms[$room->id] = $room->channel->name . ' / ' . $room->name;
        }
        $sessionSpeakers = $session->sessionSpeakers->map(function ($s){
            $speaker = $s->speaker;
            return $speaker->id;
        })->toArray();
        $session->room = $session->room->id;
        return view('sessions.edit', compact('event', 'session', 'speakers','rooms','sessionSpeakers'));
    }

    public function update(StoreRequest $request, Event $event, Session $session)
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

    public function destroy(Event $event, Session $session)
    {
        $isExist = $session->sessionRegistrations->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This session is used');
        }
        foreach ($session->sessionSpeakers as $sessionSpeaker) {
            $sessionSpeaker->delete();
        }
        $session->delete();
        return redirect()->route('events.show', $event)->with('message', 'Session successfully deleted');
    }
}
