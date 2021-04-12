<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = collect($this->resource)->except('organizer_id');
        $response['organizer'] = new OrganizerR($this->organizer);
        return $response;
    }
}
