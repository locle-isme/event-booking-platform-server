<?php

namespace App\Http\Resources\Speaker;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerOverViewRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birthday' => $this->birthday,
            'avatar' => $this->avatar,
            'social_linking' => $this->social_linking,
            'description' => $this->description,
        ];
    }
}
