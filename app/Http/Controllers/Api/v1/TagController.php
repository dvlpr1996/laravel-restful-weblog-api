<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function __construct()
    {
        $this->apiHandleRequestTraitNameSpaceSetter('post');
    }

    public function show($tag)
    {
        return $this->showApiDataCollection(Post::withAnyTag($tag)->paginate(10));
    }
}
