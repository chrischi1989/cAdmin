<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\LoginAction;
use Modules\User\UI\Web\Requests\LoginRequest;

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

    public function __invoke(LoginRequest $request)
    {
        $result = $this->loginAction->run($request, $this->loginOptions);

        return $result ? $request->success() : (session()->has('password_reset_token') ? $request->passwordExpired() : $request->failed());
    }
}
