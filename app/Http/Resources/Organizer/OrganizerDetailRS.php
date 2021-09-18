<?php

namespace App\Http\Resources\Organizer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizerDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name', 'slug');
        return $response;
    }
}
