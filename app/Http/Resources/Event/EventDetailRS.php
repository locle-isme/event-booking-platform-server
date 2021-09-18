<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Channel\ChannelDetailRS;
use App\Http\Resources\Ticket\TicketDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name', 'slug', 'date');
        $response['tickets'] = TicketDetailRS::collection($this->tickets);
        $response['channels'] = ChannelDetailRS::collection($this->channels);
        return $response;
    }
}
