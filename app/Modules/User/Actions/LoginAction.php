<?php

namespace psnXT\Modules\User\Actions;

use psnXT\Modules\User\UI\Web\Requests\LoginRequest;

class LoginAction
{
    public function __construct()
    {

    }

    public function run(LoginRequest $request) {
        $credentials = [
            'email'    => $request->post('username'),
            'password' => $request->post('password')
        ];

        return auth()->attempt($credentials, $request->has('remember-me'));
    }
}
