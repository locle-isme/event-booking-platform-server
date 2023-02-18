<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Ticket\TicketDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventRegistrationRS extends JsonResource
{
    public function toArray($request)
    {
        $sessionIds = $this->sessionRegistrations->map(function ($sessionRegistration) {
            return $sessionRegistration->session_id;
        });
        return [
            'event' => new EventDetailRS($this->ticket->event),
            'registration_time' => $this->registration_time,
            'ticket' => new TicketDetailRS($this->ticket),
            'session_ids' => $sessionIds,
        ];
    }
}
