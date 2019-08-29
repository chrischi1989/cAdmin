<?php

namespace psnXT\Modules\Dashboard\Policies;

use Arr;
use Illuminate\Auth\Access\HandlesAuthorization;
use psnXT\Modules\User\Models\User;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return Arr::has($user->permissions, 'dashboard.show');
    }
}
