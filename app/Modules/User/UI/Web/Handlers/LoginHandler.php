<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\LoginAction;
use psnXT\Modules\User\UI\Web\Requests\LoginRequest;

class LoginHandler
{
    private $loginAction;
    private $loginOptions = [
        'withDelay'          => true,
        'withPasswordExpiry' => true
    ];

    public function __construct(LoginAction $loginAction)
    {
        $this->loginAction = $loginAction;
    }

    public function __invoke(LoginRequest $loginRequest)
    {
        $result = $this->loginAction->run($loginRequest, $this->loginOptions);
        if(!$result && $this->loginOptions['withPasswordExpiry']) {
            return $loginRequest->passwordExpired();
        }

        return $result ? $loginRequest->success() : $loginRequest->failed();
    }
}
