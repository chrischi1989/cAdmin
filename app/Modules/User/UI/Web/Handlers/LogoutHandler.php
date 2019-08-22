<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

class LogoutHandler
{
    public function __construct()
    {

    }

    public function __invoke()
    {
        auth()->logout();
        session()->forget('connection');

        return redirect()->route('user-login-page');
    }
}
