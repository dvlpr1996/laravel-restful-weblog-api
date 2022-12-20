<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\LikeController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\auth\AuthController;

Route::prefix('v1')->group(function () {

    Route::GET('/', [ApiController::class, 'index'])->name('mainEndPoints');
    Route::GET('categories/{category:slug}/posts', [CategoryController::class, 'show']);
    Route::GET('tags/{tagged:slug}/posts', [TagController::class, 'show']);

    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::get('{likeable_type}/{likeable_id}/like', [LikeController::class, 'like']);
    //     Route::get('{likeable_type}/{likeable_id}/dislike', [DislikeController::class, 'dislike']);
    // });

    Route::controller(PostController::class)->group(function () {
        Route::GET('posts', 'index');
        Route::GET('posts/{post}', 'show');
        Route::GET('users/{user:slug}/posts', 'userPost');

        Route::middleware('auth:sanctum')->group(function () {
            Route::POST('posts', 'store');
            Route::POST('posts/{post:slug}', 'update');
            Route::delete('posts/{post}', 'destroy');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::GET('users', 'index');
        Route::GET('users/{user}', 'show');

        Route::middleware('auth:sanctum')->group(function () {
            Route::GET('auth/me', 'me');
            Route::Post('users/{user:slug}', 'update');
            Route::delete('users/{user}', 'destroy');
        });
    });

    Route::controller(AuthController::class)->group(function () {
        Route::Post('auth/login', 'login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::GET('auth/logout', 'logout');
        });
    });
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'page not found you can see all main available routes at '
            . route('mainEndPoints')
    ], 404);
});
