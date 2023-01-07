<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

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

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'bio' => $request->bio,
            'slug' => Str::slug($request->fname . ' ' . $request->lname),
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $token = auth()->user()->createToken($request->email);

        return response()->json([
            'message' => __('api.register_ok'),
            'token' => $token->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => __('api.logout_ok'),
        ]);
    }
}
