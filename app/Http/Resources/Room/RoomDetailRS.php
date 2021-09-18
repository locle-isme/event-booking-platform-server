<?php

namespace App\Http\Resources\Room;

use App\Http\Resources\Session\SessionDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name');
        $response['sessions'] = SessionDetailRS::collection($this->sessions);
        return $response;
    }
}
