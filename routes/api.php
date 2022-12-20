<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\auth\AuthController;

Route::prefix('v1')->group(function () {
    Route::Get('/', [ApiController::class, 'index'])->name('mainEndPoints');

    Route::controller(PostController::class)->group(function () {
        Route::Get('posts', 'index');
        Route::Get('posts/{post}', 'show')->where('post', '[0-9A-Za-z-]+');

        Route::middleware('auth:sanctum')->group(function () {
            Route::POST('posts', 'store');
            Route::POST('posts/{post:slug}', 'update')->where('post', '[0-9A-Za-z-]+');
            Route::delete('posts/{post}', 'destroy')->where('post', '[0-9A-Za-z-]+');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::Get('users/', 'index')->where('user', '[0-9A-Za-z-]+');
        Route::Get('users/{user}', 'show')->where('user', '[0-9A-Za-z-]+');

        Route::middleware('auth:sanctum')->group(function () {
            Route::Get('auth/me', 'me');
            Route::Post('users/{user:slug}', 'update')->where('user', '[0-9A-Za-z-]+');
            Route::delete('users/{user}', 'destroy')->where('user', '[0-9A-Za-z-]+');
        });
    });

    Route::controller(AuthController::class)->group(function () {
        Route::Post('auth/login', 'login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('auth/logout', 'logout');
        });
    });

    Route::get('categories/{category:slug}/posts', [CategoryController::class, 'show']);
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'page not found you can see all main available routes at '
            . route('mainEndPoints')
    ], 404);
});
