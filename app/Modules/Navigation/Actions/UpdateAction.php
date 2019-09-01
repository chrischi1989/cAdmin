<?php

namespace psnXT\Modules\Navigation\Actions;

use psnXT\Modules\Navigation\Models\Item;
use psnXT\Modules\Navigation\Tasks\FindNavigationItemTask;
use psnXT\Modules\Navigation\Tasks\UpdateNavigationItemTask;
use psnXT\Modules\Navigation\UI\Web\Requests\UpdateRequest;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class EditAction
 * @package psnXT\Modules\Navigation\Actions
 */
class UpdateAction
{
    /**
     * @var FindNavigationItemTask
     */
    private $findNavigationItemTask;

    /**
     * @var UpdateNavigationItemTask
     */
    private $updateNavigationItemTask;

    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * UpdateAction constructor.
     * @param FindNavigationItemTask $findNavigationItemTask
     * @param UpdateNavigationItemTask $updateNavigationItemTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindNavigationItemTask $findNavigationItemTask,
        UpdateNavigationItemTask $updateNavigationItemTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findNavigationItemTask   = $findNavigationItemTask;
        $this->updateNavigationItemTask = $updateNavigationItemTask;
        $this->authorizeActionTask      = $authorizeActionTask;
    }

    /**
     * @param UpdateRequest $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(UpdateRequest $request)
    {
        $this->authorizeActionTask->run('edit', Item::class);

        $item     = $this->findNavigationItemTask->byUuid($request->post('uuid'));
        $itemData = [
            'updated_uuid' => $request->user()->uuid,
            'icon'         => $request->post('icon'),
            'title'        => $request->post('title'),
            'href'         => $request->post('href'),
        ];

        return $this->updateNavigationItemTask->run($item, $itemData);
    }
}