<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\Like;
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
        $likeable_id = $like::find((int)$likeable_id)->likedBy(auth()->user());

        event(new Like(auth()->user()->fullName(), $likeable_id->user, $likeable_id->slug));

        return httpResponse(__('api.like_ok'), '201');
    }
}
