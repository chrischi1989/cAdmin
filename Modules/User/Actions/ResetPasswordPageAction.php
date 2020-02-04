<?php

namespace Modules\User\Actions;

use Modules\User\Tasks\FindPasswordResetTask;

/**
 * Class ResetPasswordPageAction
 * @package Modules\User\Actions
 */
class ResetPasswordPageAction
{
    /**
     * @var FindPasswordResetTask
     */
    private $findPasswordResetTask;

    /**
     * ResetPasswordPageAction constructor.
     * @param FindPasswordResetTask $findPasswordResetTask
     */
    public function __construct(FindPasswordResetTask $findPasswordResetTask)
    {
        $this->findPasswordResetTask = $findPasswordResetTask;
    }

    /**
     * @param $token
     * @return bool
     */
    public function run($token)
    {
        $passwordReset = $this->findPasswordResetTask->byToken($token);
        if(now() > $passwordReset->token_until) {
            return false;
        }

        return true;
    }
}
