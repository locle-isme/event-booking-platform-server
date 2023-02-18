<?php

namespace App\Http\Resources\Session;

use App\Http\Resources\Speaker\SpeakerOverViewRS;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $speakers = $this->sessionSpeakers->map(function ($sessionSpeaker) {
            return $sessionSpeaker->speaker;
        });
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type,
            'cost' => (double)$this->cost,
            'speakers' => SpeakerOverViewRS::collection($speakers),
            'organizer_slug' => $this->room->channel->event->organizer->slug,
            'event_slug' => $this->room->channel->event->slug,
        ];
    }
}
