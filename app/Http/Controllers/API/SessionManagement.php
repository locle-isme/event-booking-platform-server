<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SessionR;
use App\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionManagement extends Controller
{
    //
    function show($id)
    {
        $session = Session::find($id);
        if (!$session)
        {
            return response()->json(['message' => 'Speaker not found'], 404);
        }
        return response()->json(new SessionR($session));
    }
}
