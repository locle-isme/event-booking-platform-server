<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function create(Event $event)
    {
        $channels = $event->getAttribute('channels')->pluck('name', 'id')->toArray();
        return view('rooms.create', [
            'event' => $event,
            'channels' => $channels,
        ]);
    }

    public function store(StoreRequest $request, Event $event)
    {
        try {
            $validated = $request->validated();
            $channelId = @$validated['channel'];
            $channel = $event->channels()->where('id', $channelId)->first();
            if (!$channel) {
                return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
            }
            unset($validated['channel']);
            $result = $channel->rooms()->create($validated);
            if (empty($result)) {
                return redirect()->route('events.index', $event)->with('error-message', 'Room create failed!');
            }
            return redirect()->route('events.show', $event)->with('message', 'Room successfully created');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function edit(Event $event, Room $room)
    {
        $channels = $event->getAttribute('channels')->pluck('name', 'id')->toArray();
        return view('rooms.edit', [
            'event' => $event,
            'channels' => $channels,
            'room' => $room,
        ]);
    }

    public function update(StoreRequest $request, Event $event, Room $room)
    {
        try {
            $validated = $request->validated();
            $channel = $event->channels->where('id', $validated['channel'])->first();
            if (!$channel) {
                return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
            }
            $validated['channel_id'] = $channel->id;
            unset($validated['channel']);
            $result = $room->update($validated);
            if (empty($result)) {
                return redirect()->route('events.index', $event)->with('error-message', 'This room update failed!');
            }
            return redirect()->route('events.show', $event)->with('message', 'Room successfully updated');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function destroy(Event $event, Room $room)
    {
        try {
            $isAlready = Room::isAlready($room);
            if ($isAlready) {
                return redirect()->route('events.show', $event)->with('error-message', 'This room is used');
            }
            $room->delete();
            return redirect()->route('events.show', $event)->with('message', 'Room successfully deleted');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }
}
