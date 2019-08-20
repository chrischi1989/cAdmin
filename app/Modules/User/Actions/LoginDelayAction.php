<?php

namespace app\Modules\User\Actions;

use app\Modules\User\Tasks\SetLoginDelayTask;
use Illuminate\Http\Request;

class LoginDelayAction
{
    private $setLoginDelayTask;

    public function __construct(SetLoginDelayTask $setLoginDelayTask)
    {
        $this->setLoginDelayTask = $setLoginDelayTask;
    }

    public function run(Request $request)
    {
        $loginDelay = $request->session()->has('login_attempts') ? $this->setLoginDelayTask->run() : 0;

        return $loginDelay > 0 ? $loginDelay : 0;
    }
}
