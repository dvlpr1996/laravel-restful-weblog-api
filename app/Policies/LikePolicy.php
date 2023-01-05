<?php

namespace App\Policies;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return (($user->id === auth()->user()->id))
            ? Response::allow()
            : Response::deny('You do not have permission for this action');
    }
}
