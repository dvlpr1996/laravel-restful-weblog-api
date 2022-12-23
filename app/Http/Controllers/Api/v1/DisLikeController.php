<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class DisLikeController extends Controller
{
    private $modelNameSpace = 'App\Models\\';

    public function disLike($likeable_type, $likeable_id)
    {
        $like = $this->modelNameSpace . ucfirst($likeable_type);
        $likeable_id = $like::find((int)$likeable_id);
        $likeable_id->dislikedBy(auth()->user());

        return response()->json([
            'message' => __('api.like_ok'),
            'status_code' => '201'
        ], 201);
    }
}
