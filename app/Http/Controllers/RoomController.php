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
        $channels = [];
        foreach ($event->channels->toArray() as $channel) {
            $channels[$channel['id']] = $channel['name'];
        }
        return view('rooms.create', compact('event', 'channels'));
    }

    public function store(StoreRequest $request, Event $event)
    {
        $validated = $request->validated();
        $channel = $event->channels->where('id', $validated['channel'])->first();
        if (!$channel) {
            return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
        }
        unset($validated['channel']);
        $channel->rooms()->create($validated);
        return redirect()->route('events.show', $event)->with('message', 'Room successfully created');
    }

    public function edit(Event $event, Room $room)
    {
        $channels = [];
        foreach ($event->channels->toArray() as $channel) {
            $channels[$channel['id']] = $channel['name'];
        }
        return view('rooms.edit', compact('event', 'room', 'channels'));
    }

    public function update(StoreRequest $request, Event $event, Room $room)
    {
        $validated = $request->validated();
        $channel = $event->channels->where('id', $validated['channel'])->first();
        if (!$channel) {
            return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
        }
        $validated['channel_id'] = $channel->id;
        unset($validated['channel']);
        $room->update($validated);

        return redirect()->route('events.show', $event)->with('message', 'Room successfully updated');

    }

    public function destroy(Event $event, Room $room)
    {
        $isExist = $room->sessions->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This room is used');
        }

        $room->delete();
        return redirect()->route('events.show', $event)->with('message', 'Room successfully deleted');
    }
}
