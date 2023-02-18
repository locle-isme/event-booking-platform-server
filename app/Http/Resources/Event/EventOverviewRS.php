<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Organizer\OrganizerDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventOverviewRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'date' => $this->date,
            'active' => (bool)$this->active,
            'organizer' => new OrganizerDetailRS($this->organizer)
        ];
    }
}
