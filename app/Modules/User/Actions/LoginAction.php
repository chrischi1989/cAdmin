<?php

namespace psnXT\Modules\User\Actions;

use psnXT\Modules\User\Tasks\CleanLoginSessionTask;
use psnXT\Modules\User\Tasks\FindUserTask;
use psnXT\Modules\User\Tasks\StorePasswordResetTask;
use psnXT\Modules\User\Tasks\SetLoginAttemptsTask;
use psnXT\Modules\User\Tasks\SetLoginDelayTask;
use psnXT\Modules\User\UI\Web\Requests\LoginRequest;

class LoginAction
{
    private $findUserTask;
    private $setLoginDelayTask;
    private $setLoginAttemptsTask;
    private $storePasswordResetTask;
    private $cleanLoginSessionTask;

    public function __construct(
        FindUserTask $findUserTask,
        SetLoginDelayTask $setLoginDelayTask,
        SetLoginAttemptsTask $setLoginAttemptsTask,
        StorePasswordResetTask $storePasswordResetTask,
        CleanLoginSessionTask $cleanLoginSessionTask
    ) {
        $this->findUserTask           = $findUserTask;
        $this->setLoginDelayTask      = $setLoginDelayTask;
        $this->setLoginAttemptsTask   = $setLoginAttemptsTask;
        $this->storePasswordResetTask = $storePasswordResetTask;
        $this->cleanLoginSessionTask  = $cleanLoginSessionTask;
    }

    public function run(LoginRequest $request, $loginOptions)
    {
        $user        = $this->findUserTask->byEmail($request->post('email'));
        $credentials = [
            'email'    => $request->post('email'),
            'password' => $request->post('password')
        ];

        if (!auth()->attempt($credentials, $request->has('remember-me'))) {
            $this->setLoginAttemptsTask->run($user);

            isset($loginOptions['withDelay']) ? $this->setLoginDelayTask->run() : null;

            return false;
        }

        if (isset($loginOptions['withPasswordExpiry']) && now()->diffInDays($user->updated_at) > $user->password_expires_days && $user->password_expires) {
            return $this->storePasswordResetTask->run($user);
        }

        return $this->cleanLoginSessionTask->run();
    }
}
