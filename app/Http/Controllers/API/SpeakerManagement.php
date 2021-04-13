<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SpeakerR;
use App\Speaker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpeakerManagement extends Controller
{
    function detail($id)
    {
        $speaker = Speaker::find($id);
        if (!$speaker)
        {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json(new SpeakerR($speaker));
    }
}
