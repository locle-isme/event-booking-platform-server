<?php

namespace App\Http\Resources\Organizer;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizerDetailRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
