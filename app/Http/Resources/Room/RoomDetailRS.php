<?php

namespace App\Http\Resources\Room;

use App\Http\Resources\Session\SessionDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomDetailRS extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sessions' => SessionDetailRS::collection($this->sessions),
        ];
    }
}
