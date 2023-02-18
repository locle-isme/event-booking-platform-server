<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Channel\ChannelDetailRS;
use App\Http\Resources\Organizer\OrganizerDetailRS;
use App\Http\Resources\Ticket\TicketDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'date' => $this->date,
            'active' => (bool)$this->active,
            'organizer' => new OrganizerDetailRS($this->organizer),
            'tickets' => TicketDetailRS::collection($this->tickets),
            'channels' => ChannelDetailRS::collection($this->channels),
        ];
    }
}
