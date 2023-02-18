<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Speaker\SpeakerDetailRS;
use App\Speaker;
use App\Http\Controllers\Controller;

class SpeakerManagement extends ApiController
{
    function show($id)
    {
        $speaker = Speaker::find($id);
        if (!$speaker)
        {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json(new SpeakerDetailRS($speaker));
    }
}
