<?php

namespace App\Http\Resources\Speaker;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $speaker = $this->resource;
        $speaker->avatar = url('/') . '\\' . $speaker->avatar;
        $speaker['session_joined'] = $this->sessionSpeakers->map(function ($sessionSpeaker) {
            $end_point = collect($sessionSpeaker->session);
            $end_point['organizer_slug'] = $sessionSpeaker->session->room->channel->event->organizer->slug;
            $end_point['event_slug'] = $sessionSpeaker->session->room->channel->event->slug;
            return $end_point;
        });
        return collect($speaker)->except('session_speakers');
    }
}
