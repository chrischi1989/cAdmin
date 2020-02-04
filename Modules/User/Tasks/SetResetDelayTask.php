<?php

namespace Modules\User\Tasks;

/**
 * Class SetResetDelayTask
 * @package Modules\User\Tasks
 */
class SetResetDelayTask
{
    /**
     *
     */
    public function run()
    {
        $calculatedWaitingTime = pow(config('User.login_delay')->setting_value, session('reset_attempts'));

        session(['reset_delay' => $calculatedWaitingTime]);
    }
}
