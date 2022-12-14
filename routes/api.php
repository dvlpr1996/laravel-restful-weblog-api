<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Api\v1\PostController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::Get('/', [ApiController::class, 'index'])->name('mainEndPoints');

    Route::resource('posts', PostController::class);

});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'page not found you can see all main available routes at '
            . route('mainEndPoints')
    ], 404);
});
