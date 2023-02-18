<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => (double)$this->cost,
            'description' => $this->description,
            'available' => $this->isAvailable(),
        ];
    }
}
