<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->resourceHandlerTraitNameSpaceSetter('post');
    }

    public function show(Category $category)
    {
        return $this->showApiDataCollection($category->posts()->paginate(10));
    }
}
