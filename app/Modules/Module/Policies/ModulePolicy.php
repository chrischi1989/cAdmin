<?php

namespace psnXT\Modules\Module\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;
use psnXT\Modules\User\Models\User;

class ModulePolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return Arr::has($user->permissions, 'modules.' . $permission);
    }
}
