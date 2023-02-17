<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\Session\StoreRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Room;
use App\Session;
use App\SessionSpeaker;
use App\Speaker;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(Event $event)
    {
        $speakers = Speaker::query()->pluck('name', 'id')->toArray();
        $rooms = $event->getAttribute('rooms');
        $roomData = $rooms->map(function (Room $room) {
            $room->name = $room->getAttribute('channel')->name . ' / ' . $room->getAttribute('name');
            return $room;
        })->pluck('name', 'id')->toArray();
        return view('sessions.create', [
            'speakers' => $speakers,
            'roomData' => $roomData,
            'event' => $event,
        ]);
    }

    public function store(StoreRequest $request, Event $event)
    {
        try {
            $data = $request->validated();
            $room = $event->getAttribute('rooms')->where('id', $data['room'])->first();
            if (!$room) {
                return redirect()->back()->withInput()->withErrors(['room' => 'Room invalid']);
            }
            $isRoomAvailable = Room::isRoomValidate($room, $data);
            if (!$isRoomAvailable) {
                return redirect()->back()->withInput()->withErrors(['room' => 'Room already booked during this time']);
            }
            $speakers = $data['speakers'];
            unset($data['room'], $data['speakers']);
            $session = $room->sessions()->create($data);
            if (empty($session)) {
                return redirect()->route('events.index', $event)->with('error-message', 'Session create failed!');
            }
            foreach ($speakers as $speaker) {
                $session->sessionSpeakers()->create(
                    ['speaker_id' => $speaker]
                );
            }
            return redirect()->route('events.show', $event)->with('message', 'Session successfully created');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function edit(Event $event, Session $session)
    {
        $session->start = date('Y-m-d H:i', strtotime($session->getAttribute('start')));
        $session->end = date('Y-m-d H:i', strtotime($session->getAttribute('end')));
        $speakers = Speaker::query()->pluck('name', 'id')->toArray();
        $rooms = $event->getAttribute('rooms');
        $roomData = $rooms->map(function (Room $room) {
            $room->name = $room->getAttribute('channel')->name . ' / ' . $room->getAttribute('name');
            return $room;
        })->pluck('name', 'id')->toArray();
        $sessionSpeakers = $session->getAttribute('sessionSpeakers')->map(function ($s) {
            $speaker = $s->speaker;
            return $speaker->id;
        })->toArray();
        $session->room = $session->getAttribute('room')->id;
        return view('sessions.edit', [
            'event' => $event,
            'speakers' => $speakers,
            'roomData' => $roomData,
            'session' => $session,
            'sessionSpeakers' => $sessionSpeakers,
        ]);
    }

    public function update(StoreRequest $request, Event $event, Session $session)
    {
        try {
            $data = $request->validated();
            $room = $event->getAttribute('rooms')->where('id', $data['room'])->first();
            if (!$room) {
                return redirect()->back()->withInput()->withErrors(['room' => 'Room invalid']);
            }
            $isRoomAvailable = Room::isRoomValidate($room, $data, $session);
            if (!$isRoomAvailable) {
                return redirect()->back()->withInput()->withErrors(['room' => 'Room Room already booked during this time']);
            }

            $data['room_id'] = $data['room'];
            $speakerIds = $data['speakers'];
            unset($data['room'], $data['speakers']);
            $session->update($data);
            $oldSpeakerIds = $session->getAttribute('sessionSpeakers')->pluck('speaker_id')->toArray();
            $oldSpeakerIds = array_values(array_unique($oldSpeakerIds));
            if (array_diff($oldSpeakerIds, $speakerIds) || array_diff($speakerIds, $oldSpeakerIds)) {
                $session->removeOldSpeakers();
                $session->addNewSpeakers($speakerIds);
            }
            return redirect()->route('events.show', $event)->with('message', 'Session successfully updated');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function destroy(Event $event, Session $session)
    {
        try {
            $isAlready = Session::isAlready($session);
            if ($isAlready) {
                return redirect()->route('events.show', $event)->with('error-message', 'This session is used');
            }
            $session->removeOldSpeakers();
            $session->delete();
            return redirect()->route('events.show', $event)->with('message', 'Session successfully deleted');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }
}
