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
        $speaker = Speaker::find($this->speaker_id);
        $speaker->avatar = url('/').'\\'.$speaker->avatar;
        return $speaker;
    }
}
