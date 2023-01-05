<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->apiHandleRequestTraitNameSpaceSetter('comment');
    }

    public function index(Post $post)
    {
        return $this->showApiDataCollection($post->comments()->paginate(10));
    }

    public function store(CommentRequest $request, Post $post)
    {
        Comment::create([
            'body' => $request->body,
            'email' => $request->email,
            'author' => $request->author,
            'post_id' => $post->id,
            'reply_of' => $request->reply_of,
        ]);

        return response()->json([
            'message' => __('api.comment_ok'),
            'status_code' => '201'
        ], 201);
    }
}
