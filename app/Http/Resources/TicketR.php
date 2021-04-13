<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name', 'cost');
        $response['cost'] = (int)$response['cost'];
        $response['description'] = $this->getDescription();
        $response['available'] = $this->isAvailable();
        return $response;
    }
}
