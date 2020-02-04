<?php

namespace Modules\User\Tasks;

/**
 * Class SetResetAttemptsTask
 * @package Modules\User\Tasks
 */
class SetResetAttemptsTask
{
    /**
     *
     */
    public function run()
    {
        session([
            'reset_attempts'     => session()->has('reset_attempts') ? session('reset_attempts') + 1 : 1,
            'reset_last_attempt' => now()
        ]);
    }
}
