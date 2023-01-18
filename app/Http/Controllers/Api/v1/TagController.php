<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;

class TagController extends Controller
{
    public function __construct()
    {
        $this->resourceHandlerTraitNameSpaceSetter('post');
    }

    public function show($tag)
    {
        return $this->showApiDataCollection(Post::withAnyTag($tag)->paginate(10));
    }
}
