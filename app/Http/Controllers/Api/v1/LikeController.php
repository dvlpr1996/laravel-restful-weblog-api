<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Like;
use App\Models\Post;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    private $modelNameSpace = 'App\Models\\';

    public function __construct()
    {
        $this->authorizeResource(Like::class, 'like');
    }

    public function create($likeable_type, $likeable_id)
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
