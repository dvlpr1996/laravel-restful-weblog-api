<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Api\v1\PostController;

Route::prefix('v1')->group(function () {
    Route::Get('/', [ApiController::class, 'index'])->name('mainEndPoints');

    Route::controller(PostController::class)->group(function () {
        Route::Get('posts', 'index');
        Route::Get('posts/{post}', 'show')->where('post', '[0-9A-Za-z-]+');

        Route::middleware('auth:sanctum')->group(function () {
            Route::POST('posts', 'store');
            Route::Put('posts/{post:slug}', 'update')->where('post', '[A-Za-z-]+');
            Route::DELETE('posts/{post:slug}', 'destroy')->where('post', '[A-Za-z-]+');
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
