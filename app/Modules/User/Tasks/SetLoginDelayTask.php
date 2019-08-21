<?php

namespace psnXT\Modules\User\Tasks;

class SetLoginDelayTask
{
    public function run()
    {
        $calculatedWaitingTime = pow(config('User.login_delay')->setting_value, session('login_attempts'));

        session(['login_delay' => $calculatedWaitingTime]);
    }
}
