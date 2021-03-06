<?php

namespace Modules\User\Actions;

use Modules\User\Models\User;
use Modules\User\Tasks\AuthorizeActionTask;
use Modules\User\Tasks\FindUserTask;

/**
 * Class IndexAction
 * @package Modules\User\Actions
 */
class IndexAction
{
    /**
     * @var FindUserTask
     */
    private $findUserTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * IndexAction constructor.
     * @param FindUserTask $findUserTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(FindUserTask $findUserTask, AuthorizeActionTask $authorizeActionTask)
    {
        $this->findUserTask        = $findUserTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|User[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('show', User::class);

        return $this->findUserTask->run(['createdBy', 'updatedBy', 'tenant']);
    }
}
