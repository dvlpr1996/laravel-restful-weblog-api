<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment)
    {
        return (($user->id === auth()->user()->id) && $user->isAdmin()) ? Response::allow()
            : Response::deny('You do not have permission for this action');
    }
}
