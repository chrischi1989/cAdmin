<?php

namespace Modules\User\Tasks;

use Modules\User\Models\User;

/**
 * Class DestroyUserTask
 * @package Modules\User\Tasks
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
