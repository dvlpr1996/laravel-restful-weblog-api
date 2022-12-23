<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'page not found you can see all main available routes at '
            . route('mainEndPoints')
    ], 404);
});
