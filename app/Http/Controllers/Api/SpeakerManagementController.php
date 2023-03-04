<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Speaker\SpeakerDetailRS;
use App\Models\Speaker;

class SpeakerManagementController extends ApiController
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
