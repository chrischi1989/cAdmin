<?php

namespace Modules\Accesslayer\Policies;

use Arr;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\User;

class AccesslayerPolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return Arr::has($user->permissions, 'accesslayer.' . $permission);
    }
}
