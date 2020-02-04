<?php

namespace Modules\User\Actions;

use Modules\User\Tasks\CleanLoginSessionTask;
use Modules\User\Tasks\FindUserTask;
use Modules\User\Tasks\SetTenantTask;
use Modules\User\Tasks\StorePasswordResetTask;
use Modules\User\Tasks\SetLoginAttemptsTask;
use Modules\User\Tasks\SetLoginDelayTask;
use Modules\User\UI\Web\Requests\LoginRequest;

class LoginAction
{
    private $findUserTask;
    private $setLoginDelayTask;
    private $setLoginAttemptsTask;
    private $storePasswordResetTask;
    private $cleanLoginSessionTask;
    private $setTenantTask;

    public function __construct(
        FindUserTask $findUserTask,
        SetLoginDelayTask $setLoginDelayTask,
        SetLoginAttemptsTask $setLoginAttemptsTask,
        StorePasswordResetTask $storePasswordResetTask,
        CleanLoginSessionTask $cleanLoginSessionTask,
        SetTenantTask $setTenantTask
    ) {
        $this->findUserTask           = $findUserTask;
        $this->setLoginDelayTask      = $setLoginDelayTask;
        $this->setLoginAttemptsTask   = $setLoginAttemptsTask;
        $this->storePasswordResetTask = $storePasswordResetTask;
        $this->cleanLoginSessionTask  = $cleanLoginSessionTask;
        $this->setTenantTask          = $setTenantTask;
    }

    public function run(LoginRequest $request, $loginOptions)
    {
        $user        = $this->findUserTask->byEmail($request->post('email'));
        $credentials = [
            'email_hashed'   => hash('sha512', $request->post('email')),
            'password'       => $request->post('password'),
            'deactivated_at' => null
        ];

        $this->setTenantTask->run($user);

        if (!auth()->attempt($credentials, $request->has('remember-me'))) {
            $this->setLoginAttemptsTask->run($user);

            isset($loginOptions['withDelay']) ? $this->setLoginDelayTask->run() : null;

            return false;
        }

        if (isset($loginOptions['withPasswordExpiry']) && now()->diffInDays($user->updated_at) > $user->password_expires_days && $user->password_expires) {
            return $this->storePasswordResetTask->run($user);
        }

        return $this->cleanLoginSessionTask->run(auth()->user());
    }
}
