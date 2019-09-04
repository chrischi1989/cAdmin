<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\User;

/**
 * Class DestroyUserTask
 * @package psnXT\Modules\User\Tasks
 */
class DestroyUserTask
{
    /**
     * @param User $user
     * @return bool|null
     * @throws \Exception
     */
    public function run(User $user)
    {
        $user->accesslayer()->detach([]);
        $user->dashboards()->delete();
        $user->profile()->delete();

        return $user->delete();
    }
}
