<?php

namespace App\Http\Resources\Speaker;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $sessionsJoined = $this->sessionSpeakers->map(function ($sessionSpeaker) {
            return $sessionSpeaker->session;
        });
        $avatarUrl = url('/') . '/' . $this->avatar;
        $avatarUrl = str_replace('\\', '/', $avatarUrl);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birthday' => $this->birthday,
            'social_linking' => $this->social_linking,
            'description' => $this->description,
            'avatar' => $avatarUrl,
            'sessions_joined' => $sessionsJoined,
        ];
    }
}
