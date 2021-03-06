<?php

namespace Modules\User\Actions;

use Hash;
use Modules\User\Tasks\DestroyPasswordResetTask;
use Modules\User\Tasks\FindPasswordResetTask;
use Modules\User\Tasks\UpdateUserTask;
use Modules\User\UI\Web\Requests\ResetPasswordRequest;

/**
 * Class ResetPasswordAction
 * @package Modules\User\Actions
 */
class ResetPasswordAction
{
    /**
     * @var FindPasswordResetTask
     */
    private $findPasswordResetTask;
    /**
     * @var DestroyPasswordResetTask
     */
    private $destroyPasswordResetTask;
    private $updateUserTask;

    /**
     * ResetPasswordAction constructor.
     * @param FindPasswordResetTask $findPasswordResetTask
     * @param DestroyPasswordResetTask $destroyPasswordResetTask
     * @param UpdateUserTask $updateUserTask
     */
    public function __construct(
        FindPasswordResetTask $findPasswordResetTask,
        DestroyPasswordResetTask $destroyPasswordResetTask,
        UpdateUserTask $updateUserTask
    ) {
        $this->findPasswordResetTask = $findPasswordResetTask;
        $this->destroyPasswordResetTask = $destroyPasswordResetTask;
        $this->updateUserTask = $updateUserTask;
    }

    /**
     * @param ResetPasswordRequest $request
     * @return bool|null
     * @throws \Exception
     */
    public function run(ResetPasswordRequest $request)
    {
        $passwordReset = $this->findPasswordResetTask->byToken($request->post('token'), ['user']);
        if (now() > $passwordReset->token_until) {
            return false;
        }

        $data = ['password' => Hash::make($request->post('password'))];

        if(!$this->updateUserTask->run($passwordReset->user, $data)) {
            return false;
        }

        return $this->destroyPasswordResetTask->run($passwordReset);
    }
}
