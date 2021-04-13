<?php

namespace App\Http\Resources;

use App\Speaker;
use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this->resource);
        $speaker = $this->resource;
        $speaker->avatar = url('/').'\\'.$speaker->avatar;
        $speaker['session_joined'] = $this->sessionSpeakers->map(function ($sessionSpeaker){
            $end_point = collect($sessionSpeaker->session);
            $end_point['organizer_slug'] = $sessionSpeaker->session->room->channel->event->organizer->slug;
            $end_point['event_slug'] = $sessionSpeaker->session->room->channel->event->slug;
            return $end_point;
        });
        return collect($speaker)->except('session_speakers');
    }
}
