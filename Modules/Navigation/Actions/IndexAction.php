<?php

namespace Modules\Navigation\Actions;

use Modules\Navigation\Models\Item;
use Modules\Navigation\Tasks\FindNavigationItemTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class IndexAction
 * @package Modules\Navigation\Actions
 */
class IndexAction
{
    /**
     * @var FindNavigationItemTask
     */
    private $findNavigationItemTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * IndexAction constructor.
     * @param FindNavigationItemTask $findNavigationItemTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(FindNavigationItemTask $findNavigationItemTask, AuthorizeActionTask $authorizeActionTask)
    {
        view()->share('active', 'navigation');

        $this->authorizeActionTask    = $authorizeActionTask;
        $this->findNavigationItemTask = $findNavigationItemTask;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Item[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('show', Item::class);

        return $this->findNavigationItemTask->run();
    }
}
