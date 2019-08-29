<?php

namespace psnXT\Modules\Dashboard\Policies;

use Arr;
use Illuminate\Auth\Access\HandlesAuthorization;
use psnXT\Modules\User\Models\User;

class DashboardPolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return Arr::has($user->permissions, 'accesslayer.' . $permission);
    }
}
