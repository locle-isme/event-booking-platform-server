<?php

namespace App\Http\Resources\Channel;

use App\Http\Resources\Room\RoomDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelDetailRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->only('id', 'name');
        $response['rooms'] = RoomDetailRS::collection($this->rooms);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rooms' => RoomDetailRS::collection($this->rooms),
        ];
    }
}
