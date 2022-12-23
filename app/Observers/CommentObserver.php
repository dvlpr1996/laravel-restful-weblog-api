<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function deleted(Comment $comment)
    {
        Comment::where('reply_of', $comment->id)->delete();
    }
}
