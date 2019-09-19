<?php

namespace psnXT\Modules\User\Actions;

class LogoutAction
{
    public function __construct()
    {

    }

    public function run()
    {
        unset(auth()->user()->priority, auth()->user()->permissions);

        session()->forget('connection');
        auth()->logout();

        return true;
    }
}
