<?php

namespace Modules\Dashboard\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\User;

class DashboardPolicy
{
    use HandlesAuthorization;

    public function __call($permission, $arguments)
    {
        /** @var User $user */
        $user = $arguments[0];

        return $user->permissions->get('dashboard')->contains($permission);
    }
}
