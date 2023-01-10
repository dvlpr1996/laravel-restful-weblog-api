<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Comment;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->resourceHandlerTraitNameSpaceSetter('user');
    }

    public function index()
    {
        return $this->showApiDataResource(auth()->user());
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        Comment::findOrFail($comment->id)->delete();
        
        return httpResponse(__('api.comment_delete_ok'), '200');
    }
}
