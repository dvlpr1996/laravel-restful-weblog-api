<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user)
    {
        return (($user->id === auth()->user()->id) && $user->isAdmin()) ? Response::allow() :
            Response::deny('You do not have permission for this action');
    }
}
