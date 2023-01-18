<?php

if (! function_exists('httpResponse')) {
    function httpResponse(string $message, string $statusCode)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $statusCode,
        ], (int) $statusCode);
    }
}
