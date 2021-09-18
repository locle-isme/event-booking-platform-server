<?php

namespace App\Http\Resources\Session;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->except('room_id');
        $response['speakers'] = $this->sessionSpeakers->map(function ($sessionSpeaker) {
            return $sessionSpeaker->speaker;
        });
        $response['organizer_slug'] = $this->resource->room->channel->event->organizer->slug;
        $response['event_slug'] = $this->resource->room->channel->event->slug;
        $response['cost'] = (int) $response['cost'];
        return $response;
    }
}
