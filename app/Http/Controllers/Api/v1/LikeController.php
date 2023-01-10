<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\likeActionTrait;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    use likeActionTrait;

    public function __construct()
    {
        $this->authorizeResource(Like::class, 'like');
    }

    public function create($likeable_type, $likeable_id)
    {
        $this->likeAction($likeable_type, $likeable_id, true);
        return httpResponse(__('api.like_ok'), '201');
    }
}
