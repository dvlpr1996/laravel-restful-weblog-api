<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $model)
    {
        if ($user->isAdmin())
            return true;

        if ($user->isWriter())
            return ($user->id === $model->id) ? Response::allow()
                : Response::deny('You do not have permission for this action');
    }

    public function delete(User $user, User $model)
    {
        if ($user->isAdmin())
            return true;

        if ($user->isWriter())
            return ($user->id === $model->id) ? Response::allow()
                : Response::deny('You do not have permission for this action');
    }
}
