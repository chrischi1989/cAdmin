<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\LogoutAction;

class LogoutHandler
{
    private $logoutAction;

    public function __construct(LogoutAction $logoutAction)
    {
        $this->logoutAction = $logoutAction;
    }

    public function __invoke()
    {
        $this->logoutAction->run();

        return redirect()->route('user-login-page');
    }
}
