<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return new PostCollection($category->posts()->paginate(10));
    }
}
