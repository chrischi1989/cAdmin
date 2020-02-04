<?php

namespace Modules\Navigation\Actions;

use Illuminate\Http\Request;
use Modules\Navigation\Models\Item;
use Modules\Navigation\Tasks\FindNavigationItemTask;
use Modules\Navigation\Tasks\UpdateNavigationItemTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class SortAction
 * @package Modules\Navigation\Actions
 */
class SortAction
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
     * SortAction constructor.
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
     * @param Request $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(Request $request)
    {
        $this->authorizeActionTask->run('edit', Item::class);

        return $this->sort($request->post('data'));
    }

    /**
     * @param array $data
     * @param null $parentUuid
     * @return bool
     */
    private function sort(array $data, $parentUuid = null)
    {
        foreach ($data as $key => $item) {
            if (isset($item['children'])) {
                $this->sort($item['children'], $item['id']);
            }

            $item     = $this->findNavigationItemTask->byUuid($item['id']);
            $itemData = [
                'updated_uuid' => request()->user()->uuid,
                'parent_uuid'  => !is_null($parentUuid) ? $parentUuid : null,
                'position'     => $key
            ];

            $this->updateNavigationItemTask->run($item, $itemData);
        }

        return true;
    }
}