<?php

namespace Modules\User\Tasks;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class CleanLoginSessionTask
 * @package Modules\User\Tasks
 */
class CleanLoginSessionTask
{
    /**
     * @param Authenticatable $user
     * @return mixed
     */
    public function run(Authenticatable $user)
    {
        session()->forget([
            'login_attempts',
            'login_delay',
            'login_last_attempt'
        ]);

        $user->lastlogin_at = now();

        return $user->save();
    }
}
