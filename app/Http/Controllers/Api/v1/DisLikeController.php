<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\likeActionTrait;
use App\Http\Controllers\Controller;

class DisLikeController extends Controller
{
    use likeActionTrait;

    public function __construct()
    {
        $this->authorizeResource(Like::class, 'like');
    }

    public function create($likeable_type, $likeable_id)
    {
        $this->likeAction($likeable_type, $likeable_id, false);
        return httpResponse(__('api.dislike_ok'), '201');
    }
}
