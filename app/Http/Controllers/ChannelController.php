<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Event;
use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
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
        return view('channels.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, CreateChannelRequest $request)
    {
        //
        $event->channels()->create($request->validated());
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Channel $channel)
    {
        return view('channels.edit', compact('event', 'channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateChannelRequest $request
     * @param Event $event
     * @param \App\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChannelRequest $request, Event $event, Channel $channel)
    {
        //
        $channel->update($request->validated());
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @param \App\Channel $channel
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event, Channel $channel)
    {
        //
        $isExist = $channel->rooms->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This channel is used');
        }

        $channel->delete();
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully deleted');
    }
}
