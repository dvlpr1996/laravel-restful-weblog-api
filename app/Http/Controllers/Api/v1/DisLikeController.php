<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class DisLikeController extends Controller
{
    private $modelNameSpace = 'App\Models\\';

    public function __construct()
    {
        $this->authorizeResource(Like::class, 'like');
    }

    public function create($likeable_type, $likeable_id)
    {
        $like = $this->modelNameSpace . ucfirst($likeable_type);
        $likeable_id = $like::find((int)$likeable_id)->dislikedBy(auth()->user());

        return httpResponse(__('api.dislike_ok'), '201');

    }
}
