<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Ticket\TicketDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventRegistrationRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'event' => new EventDetailRS($this->ticket->event),
            'registration_time' => $this->registration_time,
            'ticket' => new TicketDetailRS($this->ticket),
            'session_ids' => $this->sessionRegistrations->map(function ($item) {
                return $item->session_id;
            })
        ];
    }
}
