<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Session\SessionDetailRS;
use App\Models\Session;

class SessionManagementController extends ApiController
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
