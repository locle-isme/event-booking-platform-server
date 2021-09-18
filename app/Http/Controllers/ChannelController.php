<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Event;
use App\Http\Requests\Channel\StoreRequest;

class ChannelController extends Controller
{
    public function create(Event $event)
    {
        return view('channels.create', compact('event'));
    }

    public function store(StoreRequest $request, Event $event)
    {
        $event->channels()->create($request->validated());
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully created');
    }

    public function edit(Event $event, Channel $channel)
    {
        return view('channels.edit', compact('event', 'channel'));
    }

    public function update(StoreRequest $request, Event $event, Channel $channel)
    {
        $channel->update($request->validated());
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully updated');
    }

    public function destroy(Event $event, Channel $channel)
    {
        $isExist = $channel->rooms->count();
        if ($isExist) {
            return redirect()->route('events.show', $event)->with('error-message', 'This channel is used');
        }
        $channel->delete();
        return redirect()->route('events.show', $event)->with('message', 'Channel successfully deleted');
    }
}
