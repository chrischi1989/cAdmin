<?php

namespace Modules\User\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
    public function __construct(FindUserTask $findUserTask, AuthorizeActionTask $authorizeActionTask, Factory $view)
    {
        $this->findUserTask        = $findUserTask;
        $this->authorizeActionTask = $authorizeActionTask;

        $view->share('active', 'user');
    }

    /**
     * @return Builder[]|Collection|User[]
     * @throws AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('show', User::class);

        return $this->findUserTask->run(['createdBy', 'updatedBy', 'tenant']);
    }
}
