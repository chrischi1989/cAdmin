<?php

namespace psnXT\Modules\User\Actions;

use psnXT\Modules\User\Models\User;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;
use psnXT\Modules\User\Tasks\DestroyUserTask;
use psnXT\Modules\User\Tasks\FindUserTask;
use psnXT\Modules\User\UI\Web\Requests\DestroyRequest;

/**
 * Class DestroyAction
 * @package psnXT\Modules\User\Actions
 */
class DestroyAction
{
    /**
     * @var FindUserTask
     */
    private $findUserTask;
    /**
     * @var DestroyUserTask
     */
    private $destroyUserTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * DestroyAction constructor.
     * @param FindUserTask $findUserTask
     * @param DestroyUserTask $destroyUserTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindUserTask $findUserTask,
        DestroyUserTask $destroyUserTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findUserTask        = $findUserTask;
        $this->destroyUserTask     = $destroyUserTask;
        $this->authorizeActionTask = $authorizeActionTask;
    }

    /**
     * @param DestroyRequest $request
     * @return bool|null
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(DestroyRequest $request)
    {
        $this->authorizeActionTask->run('destroy', User::class);

        $user = $this->findUserTask->byUuid($request->post('uuid'));

        return $this->destroyUserTask->run($user);
    }
}
