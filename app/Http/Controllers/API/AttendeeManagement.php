<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeeManagement extends Controller
{
    //

    public function login(Request $request)
    {
        $attendee = Attendee::where(['lastname' => $request->lastname, 'registration_code' => $request->registration_code])->first();
        if (!$attendee) {
            return response()->json(['message' => 'Invalid login'], 401);
        }

        $attendee->update([
            'login_token' => md5($attendee->username)
        ]);

        $response = collect($attendee)->only('firstname','lastname','username','email');
        $response['token'] = $attendee->login_token;
        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $attendee = Attendee::where(['login_token' => $request->token])->first();
        if (!$attendee) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $attendee->update([
            'login_token' => ""
        ]);

        return response()->json(['message' => 'Logout success']);
    }

}
