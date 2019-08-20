<?php

namespace app\Modules\User\Actions;

use Illuminate\Http\Request;

class ResetDelayAction
{
    private $setResetDelayTask;

    public function __construct(SetResetDelayTask $setResetDelayTask)
    {
        $this->setResetDelayTask = $setResetDelayTask;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|int|mixed
     */
    public function run(Request $request) {
        $resetDelay = $request->session()->has('reset_attempts') ? $this->setResetDelayTask->run() : 0;

        return $resetDelay > 0 ? $resetDelay : 0;
    }
}
