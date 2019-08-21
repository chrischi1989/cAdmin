<?php

namespace psnXT\Modules\User\Tasks;

/**
 * Class SetResetDelayTask
 * @package psnXT\Modules\User\Tasks
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
