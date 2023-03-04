<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Http\Requests\Channel\StoreRequest;

class ChannelController extends Controller
{
    public function create(Event $event)
    {
        return view('channels.create', [
            'event' => $event,
        ]);
    }

    public function store(StoreRequest $request, Event $event)
    {
        try {
            $result = $event->channels()->create($request->validated());
            if (empty($result)) {
                return redirect()->route('events.show', $event)->with('error-message', 'Channel create failed');
            }
            return redirect()->route('events.show', $event)->with('message', 'Channel successfully created');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function edit(Event $event, Channel $channel)
    {
        return view('channels.edit', [
            'event' => $event,
            'channel' => $channel,
        ]);
    }

    public function update(StoreRequest $request, Event $event, Channel $channel)
    {
        try {
            $result = $channel->update($request->validated());
            if (empty($result)) {
                return redirect()->route('events.show', $event)->with('error-message', 'This channel update failed');
            }
            return redirect()->route('events.show', $event)->with('message', 'Channel successfully updated');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }

    public function destroy(Event $event, Channel $channel)
    {
        try {
            $isAlready = Channel::isAlready($channel);
            if ($isAlready) {
                return redirect()->route('events.show', $event)->with('error-message', 'This channel is used');
            }
            $channel->delete();
            return redirect()->route('events.show', $event)->with('message', 'Channel successfully deleted');
        } catch (\Throwable $e) {
            return redirect()->route('events.index', $event)->with('error-message', 'Something error please retry again!');
        }
    }
}
