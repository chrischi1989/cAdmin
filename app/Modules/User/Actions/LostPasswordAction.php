<?php

namespace psnXT\Modules\User\Actions;

use psnXT\Modules\User\Tasks\CleanPasswordResetSessionTask;
use psnXT\Modules\User\Tasks\FindUserTask;
use psnXT\Modules\User\Tasks\SendPasswordResetEmailTask;
use psnXT\Modules\User\Tasks\StorePasswordResetTask;
use psnXT\Modules\User\Tasks\SetResetAttemptsTask;
use psnXT\Modules\User\Tasks\SetResetDelayTask;
use psnXT\Modules\User\UI\Web\Requests\LostPasswordRequest;

/**
 * Class LostPasswordAction
 * @package psnXT\Modules\User\Actions
 */
class LostPasswordAction
{
    /**
     * @var FindUserTask
     */
    private $findUserTask;
    /**
     * @var SetResetAttemptsTask
     */
    private $setResetAttemptsTask;
    /**
     * @var SetResetDelayTask
     */
    private $setResetDelayTask;
    /**
     * @var StorePasswordResetTask
     */
    private $storePasswordResetTask;
    /**
     * @var SendPasswordResetEmailTask
     */
    private $sendPasswordResetEmailTask;
    /**
     * @var CleanPasswordResetSessionTask
     */
    private $cleanPasswordResetSessionTask;

    /**
     * LostPasswordAction constructor.
     * @param FindUserTask $findUserTask
     * @param SetResetAttemptsTask $setResetAttemptsTask
     * @param SetResetDelayTask $setResetDelayTask
     * @param StorePasswordResetTask $storePasswordResetTask
     * @param SendPasswordResetEmailTask $sendPasswordResetEmailTask
     * @param CleanPasswordResetSessionTask $cleanPasswordResetSessionTask
     */
    public function __construct(
        FindUserTask $findUserTask,
        SetResetAttemptsTask $setResetAttemptsTask,
        SetResetDelayTask $setResetDelayTask,
        StorePasswordResetTask $storePasswordResetTask,
        SendPasswordResetEmailTask $sendPasswordResetEmailTask,
        CleanPasswordResetSessionTask $cleanPasswordResetSessionTask
    ) {
        $this->findUserTask                  = $findUserTask;
        $this->setResetAttemptsTask          = $setResetAttemptsTask;
        $this->setResetDelayTask             = $setResetDelayTask;
        $this->storePasswordResetTask        = $storePasswordResetTask;
        $this->sendPasswordResetEmailTask    = $sendPasswordResetEmailTask;
        $this->cleanPasswordResetSessionTask = $cleanPasswordResetSessionTask;
    }

    /**
     * @param LostPasswordRequest $request
     * @return bool
     */
    public function run(LostPasswordRequest $request)
    {
        $user = $this->findUserTask->byEmail($request->post('email'));
        if (is_null($user)) {
            $this->setResetAttemptsTask->run();
            $this->setResetDelayTask->run();

            return false;
        }

        if (!$this->storePasswordResetTask->run($user)) {
            return false;
        }

        if (!$this->sendPasswordResetEmailTask->run($user)) {
            return false;
        }

        return $this->cleanPasswordResetSessionTask->run();
    }
}
