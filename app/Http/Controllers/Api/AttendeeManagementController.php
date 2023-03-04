<?php

namespace App\Http\Controllers\API;

use App\Models\Attendee;
use App\Http\Requests\Attendee\StoreRequest;
use App\Http\Resources\Attendee\AttendeeDetailRS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendeeManagementController extends ApiController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!$token = $this->auth->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $attendee = Attendee::create($validated);
        if (!empty($attendee)){
            return response()->json(new AttendeeDetailRS($attendee));
        }
        return response()->json(['message' => 'Register failed', 500]);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logout success']);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => new AttendeeDetailRS($this->auth->user()),
        ]);
    }

    public function refresh() {
        return $this->createNewToken($this->auth->refresh());
    }
}
