<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'event' => new EventR($this->ticket->event),
            'session_ids' => $this->sessionRegistrations->map(function ($sr) {
                return $sr->session_id;
            })
        ];
        return $response;
    }
}
