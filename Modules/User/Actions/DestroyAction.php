<?php

namespace Modules\User\Actions;

use Modules\User\Models\User;
use Modules\User\Tasks\AuthorizeActionTask;
use Modules\User\Tasks\DestroyUserTask;
use Modules\User\Tasks\FindUserTask;
use Modules\User\UI\Web\Requests\DestroyRequest;

/**
 * Class DestroyAction
 * @package Modules\User\Actions
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
