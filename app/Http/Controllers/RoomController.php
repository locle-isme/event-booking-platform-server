<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
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
        return view('rooms.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, CreateRoomRequest $request)
    {
        //
        $validated = $request->validated();
        $channel = $event->channels->where('id', $validated['channel'])->first();
        if (!$channel) {
            return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
        }

        unset($validated['channel']);
        $channel->rooms()->create($validated);
        return redirect()->route('events.show', $event)->with('message', 'Room successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Room $room)
    {
        //
        return view('rooms.edit', compact('event', 'room'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Event $event, Room $room)
    {
        //
        $validated = $request->validated();
        $channel = $event->channels->where('id', $validated['channel'])->first();
        if (!$channel) {
            return redirect()->back()->withInput()->withErrors(['channel' => 'Channel invalid']);
        }
        $validated['channel_id'] = $channel->id;
        unset($validated['channel']);
        //dd($validated);
        $room->update($validated);

        return redirect()->route('events.show', $event)->with('message', 'Room successfully updated');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event,Room $room)
    {
        //
        $isExist = $room->sessions->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This room is used');
        }

        $room->delete();
        return redirect()->route('events.show', $event)->with('message', 'Room successfully deleted');
    }
}
