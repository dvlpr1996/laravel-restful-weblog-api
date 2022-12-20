<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;

class TagController extends Controller
{
    public function show($tag)
    {
        return new PostCollection(Post::withAnyTag($tag)->paginate(10));
    }
}
