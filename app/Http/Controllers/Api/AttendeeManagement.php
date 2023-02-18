<?php

namespace App\Http\Controllers\API;

use App\Attendee;
use App\Http\Requests\Attendee\StoreRequest;
use App\Http\Resources\Attendee\AttendeeDetailRS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AttendeeManagement extends Controller
{
    public function login(Request $request)
    {
       /* $attendee = Attendee::where(['username' => $request->username, 'password' => md5($request->password)])->first();
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
        return response()->json($response);*/
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = md5($validated['password']);
        $validated['login_token'] = '';
        $attendee = Attendee::create($validated);
        $data = collect($attendee)->only('username', 'email', 'firstname', 'lastname')->toArray();
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        auth('api')->logout();
        $attendee = Attendee::where(['login_token' => $request->token])->first();
        if (!$attendee) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
        $attendee->update(['login_token' => '']);
        return response()->json(['message' => 'Logout success']);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => new AttendeeDetailRS(auth('api')->user()),
        ]);
    }

    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }
}
