<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return (($user->id === auth()->user()->id) && $user->isWriter()) ? Response::allow()
            : Response::deny('You do not have permission for this action');
    }

    public function update(User $user, Post $post)
    {
        return (($user->id === auth()->user()->id) && $user->id === $post->user_id) ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    public function delete(User $user, Post $post)
    {
        return (($user->id === auth()->user()->id) && $user->id === $post->user_id) ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
