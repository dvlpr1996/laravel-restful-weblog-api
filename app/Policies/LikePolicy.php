<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

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
