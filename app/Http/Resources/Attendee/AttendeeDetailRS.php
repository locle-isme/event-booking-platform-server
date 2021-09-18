<?php

namespace App\Http\Resources\Attendee;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeDetailRS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
