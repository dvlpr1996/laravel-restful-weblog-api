<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
