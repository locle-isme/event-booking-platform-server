<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = collect($this->resource)->except('room_id');
        //$response['speakers'] = SessionSpeakersR::collection($this->sessionSpeakers);
        $response['speakers'] = $this->sessionSpeakers->map(function ($sessionSpeaker) {
            return $sessionSpeaker->speaker;
        });
        $response['organizer_slug'] = $this->resource->room->channel->event->organizer->slug;
        $response['event_slug'] = $this->resource->room->channel->event->slug;
        $response['cost'] = (int)$response['cost'];
        return $response;
    }
}
