<?php

namespace psnXT\Modules\User\Actions;

use app\Modules\User\Tasks\FindUserTask;
use app\Modules\User\Tasks\SetLoginAttemptsTask;
use app\Modules\User\Tasks\SetLoginDelayTask;
use psnXT\Modules\User\UI\Web\Requests\LoginRequest;

class LoginAction
{
    private $findUserTask;
    private $authenticateUserTask;
    private $setLoginDelayTask;
    private $setLoginAttemptsTask;

    public function __construct(
        FindUserTask $findUserTask,
        SetLoginDelayTask $setLoginDelayTask,
        SetLoginAttemptsTask $setLoginAttemptsTask
    ) {
        $this->findUserTask         = $findUserTask;
        $this->authenticateUserTask = $authenticateUserTask;
        $this->setLoginDelayTask    = $setLoginDelayTask;
        $this->setLoginAttemptsTask = $setLoginAttemptsTask;
    }

    public function run(LoginRequest $request, $loginOptions)
    {
        $user = $this->findUserTask->byEmail($request->post('email'));
        if(is_null($user)) return false;

        $auth = auth()->attempt([
            'email'    => $user->email,
            'password' => $request->post('password')
        ]);

        if(!$auth) {

            $loginAttempts = $request->session()->has('login_attempts') ? $this->setLoginAttemptsTask->run() : 1;

            if($loginOptions['withDelay']) {
                $loginDelay = $request->session()->has('login_attempts') ? $this->setLoginDelayTask->run() : 0;
                if($loginDelay > 0) {
                    session([
                        'login_attempts'    => $loginAttempts,
                        'login_delay'       => pow(config('User.login_delay')->setting_value, $loginAttempts),
                        'login_lastattempt' => now(),
                    ]);
                }
            }

            return false;
        }

        if($loginOptions['withPasswordExpiry']) {
            if (now()->diffInDays($user->updated_at) > $user->password_expires_days && $user->password_expires) {
                $this->passwordResetEntity->add($user);

                return false;
            }

            return true;
        }

        $request->session()->forget([
            'login_attempts',
            'reset_attempts',
            'login_delay',
            'reset_delay',
            'login_lastattempt',
            'reset_lastattempt'
        ]);

        return true;
    }
}
