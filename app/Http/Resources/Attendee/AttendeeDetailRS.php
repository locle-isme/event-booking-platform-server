<?php

namespace App\Http\Resources\Attendee;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeDetailRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
        ];
    }
}
