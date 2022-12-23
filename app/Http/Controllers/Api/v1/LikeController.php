<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    private $modelNameSpace = 'App\Models\\';

    public function like($likeable_type, $likeable_id)
    {
        $like = $this->modelNameSpace . ucfirst($likeable_type);
        $likeable_id = $like::find((int)$likeable_id);
        $likeable_id->likedBy(auth()->user());

        return response()->json([
            'message' => __('api.like_ok'),
            'status_code' => '201'
        ], 201);
    }
}
