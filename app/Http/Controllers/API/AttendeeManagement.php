<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use App\Http\Requests\CreateAttendeeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class AttendeeManagement extends Controller
{
    //

    public function login(Request $request)
    {
        $attendee = Attendee::where(['username' => $request->username, 'password' => md5($request->password)])->first();
        if (!$attendee) {
            return response()->json(['message' => 'Invalid login'], 401);
        }

        if (empty($attendee->login_token)) {
            $attendee->update([
                'login_token' => base64_encode(md5(Str::random(10) . microtime()))
            ]);
        }

        $response = collect($attendee)->only('firstname', 'lastname', 'username', 'email');
        $response['token'] = $attendee->login_token;
        return response()->json($response);
    }

    public function register(CreateAttendeeRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = md5($validated['password']);
        $validated['login_token'] = '';
        $attendee = Attendee::create($validated);
        return response()->json(collect($attendee)->only('username', 'email', 'firstname', 'lastname')->toArray());
    }

    public function logout(Request $request)
    {
        $attendee = Attendee::where(['login_token' => $request->token])->first();
        if (!$attendee) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $attendee->update(['login_token' => '']);

        return response()->json(['message' => 'Logout success']);
    }

}
