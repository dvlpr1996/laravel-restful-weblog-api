<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Http\Controllers\Controller;

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
