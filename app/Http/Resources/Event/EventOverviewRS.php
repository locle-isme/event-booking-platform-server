<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\Organizer\OrganizerDetailRS;
use Illuminate\Http\Resources\Json\JsonResource;

class EventOverviewRS extends JsonResource
{
    public function toArray($request)
    {
        $response = collect($this->resource)->except('organizer_id');
        $response['organizer'] = new OrganizerDetailRS($this->organizer);
        return $response;
    }
}
