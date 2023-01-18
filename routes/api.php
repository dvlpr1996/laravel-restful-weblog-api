<?php

use App\Http\Controllers\Api\v1\AdminController;
use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Api\v1\auth\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\DisLikeController;
use App\Http\Controllers\Api\v1\LikeController;
use App\Http\Controllers\Api\V1\PdfController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::GET('/', [ApiController::class, 'index'])->name('mainEndPoints');
    Route::GET('categories/{category:slug}/posts', [CategoryController::class, 'show']);
    Route::GET('tags/{tagged:slug}/posts', [TagController::class, 'show']);
    Route::GET('pdf/{post:slug}', [PdfController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('{likeable_type}/{likeable_id}/like', [LikeController::class, 'create']);
        Route::get('{likeable_type}/{likeable_id}/dislike', [DisLikeController::class, 'create']);
    });

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
            Route::Get('users/{user:slug}/destroy', 'destroy');
        });
    });

    Route::controller(AuthController::class)->group(function () {
        Route::Post('auth/login', 'login');
        Route::Post('auth/register', 'register');
        Route::middleware('auth:sanctum')->group(function () {
            Route::GET('auth/logout', 'logout');
        });
    });

    Route::controller(CommentController::class)->group(function () {
        Route::Get('posts/{post:slug}/comments', 'index');
        Route::Post('posts/{post:slug}/comments', 'store');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::Get('admin/', 'index');
            Route::Get('comments/{comment}', 'destroy');
        });
    });
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'page not found you can see all main available routes at '
            .route('mainEndPoints'),
    ], 404);
});
