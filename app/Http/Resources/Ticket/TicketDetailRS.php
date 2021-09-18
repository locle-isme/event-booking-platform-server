<?php

namespace App\Http\Resources\Ticket;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name', 'cost');
        $response['cost'] = (int)$response['cost'];
        $response['description'] = $this->description;
        $response['available'] = $this->isAvailable();
        return $response;
    }
}
