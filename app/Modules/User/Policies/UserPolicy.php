<?php

namespace psnXT\Modules\User\Policies;

use Arr;
use Illuminate\Auth\Access\HandlesAuthorization;
use psnXT\Modules\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return Arr::has($user->permissions, 'user.' . $permission);
    }
}
