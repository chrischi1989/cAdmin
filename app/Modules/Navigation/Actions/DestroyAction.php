<?php

namespace psnXT\Modules\Navigation\Actions;

use psnXT\Modules\Navigation\Tasks\DestroyNavigationItem;
use psnXT\Modules\Navigation\Tasks\FindNavigationItemTask;
use psnXT\Modules\Navigation\UI\Web\Requests\DestroyRequest;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class DestroyAction
 * @package psnXT\Modules\Navigation\Actions
 */
class DestroyAction
{
    /**
     * @var FindNavigationItemTask
     */
    private $findNavigationItemTask;
    /**
     * @var DestroyNavigationItem
     */
    private $destroyNavigationItemTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * DestroyAction constructor.
     * @param FindNavigationItemTask $findNavigationItemTask
     * @param DestroyNavigationItem $destroyNavigationItem
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindNavigationItemTask $findNavigationItemTask,
        DestroyNavigationItem $destroyNavigationItem,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findNavigationItemTask    = $findNavigationItemTask;
        $this->destroyNavigationItemTask = $destroyNavigationItem;
        $this->authorizeActionTask       = $authorizeActionTask;
    }

    /**
     * @param DestroyRequest $request
     * @return bool|null
     */
    public function run(DestroyRequest $request)
    {
        $item = $this->findNavigationItemTask->byUuid($request->post('uuid'));

        return $this->destroyNavigationItemTask->run($item);
    }
}