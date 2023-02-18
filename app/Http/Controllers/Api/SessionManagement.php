<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Session\SessionDetailRS;
use App\Session;
use App\Http\Controllers\Controller;

class SessionManagement extends ApiController
{
    function show($id)
    {
        $session = Session::find($id);
        if (!$session) {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json(new SessionDetailRS($session));
    }
}
