<?php

namespace Modules\Navigation\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;
use Modules\User\Models\User;

class NavigationPolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return $user->permissions->get('navigation')->contains($permission);
    }
}
