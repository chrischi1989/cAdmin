<?php


namespace psnXT\Modules\User\UI\Web\Handlers;


use psnXT\Modules\User\Actions\LoginAction;
use psnXT\Modules\User\UI\Web\Requests\LoginRequest;

class LoginHandler
{
    private $loginAction;

    public function __construct(LoginAction $loginAction)
    {
        $this->loginAction = $loginAction;
    }

    public function __invoke(LoginRequest $loginRequest)
    {
        $this->loginAction->run($loginRequest) ? $loginRequest->success() : $loginRequest->failed();
    }
}
