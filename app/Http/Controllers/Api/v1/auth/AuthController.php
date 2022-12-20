<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = auth()->user()->createToken($request->email);

        return response()->json([
            'message' => 'welcome back dear ' . auth()->user()->fullName(),
            'token' => $token->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'you successfully log out',
        ]);
    }
}
