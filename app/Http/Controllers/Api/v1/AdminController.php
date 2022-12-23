<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AdminController extends Controller
{
    public function index()
    {
        return new UserResource(auth()->user());
    }

    public function destroy(Comment $comment)
    {
        Comment::findOrFail($comment->id)->delete();

        return response()->json([
            'message' => __('api.comment_delete_ok'),
            'status_code' => '200'
        ], 200);
    }
}
