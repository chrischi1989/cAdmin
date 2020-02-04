<?php

namespace Modules\Navigation\Actions;

use Modules\Navigation\Models\Item;
use Modules\Navigation\Tasks\FindNavigationItemTask;
use Modules\Navigation\Tasks\GetAvailableRoutesTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class EditAction
 * @package Modules\Navigation\Actions
 */
class EditAction
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
     * @var GetAvailableRoutesTask
     */
    private $getAvailableRoutesTask;

    /**
     * EditAction constructor.
     * @param FindNavigationItemTask $findNavigationItemTask
     * @param GetAvailableRoutesTask $getAvailableRoutesTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindNavigationItemTask $findNavigationItemTask,
        GetAvailableRoutesTask $getAvailableRoutesTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findNavigationItemTask = $findNavigationItemTask;
        $this->authorizeActionTask    = $authorizeActionTask;
        $this->getAvailableRoutesTask = $getAvailableRoutesTask;

        view()->share('active', 'navigation');
    }

    /**
     * @param $itemUuid
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run($itemUuid)
    {
        $this->authorizeActionTask->run('edit', Item::class);

        return [
            'routes' => $this->getAvailableRoutesTask->run(),
            'item'   => $this->findNavigationItemTask->byUuid($itemUuid)
        ];
    }
}