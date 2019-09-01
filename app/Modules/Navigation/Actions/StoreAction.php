<?php

namespace psnXT\Modules\Navigation\Actions;

use psnXT\Modules\Navigation\Models\Item;
use psnXT\Modules\Navigation\Tasks\StoreNavigationItemTask;
use psnXT\Modules\Navigation\UI\Web\Requests\StoreRequest;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;

class StoreAction
{
    private $storeNavigationItemTask;
    private $authorizeActionTask;

    public function __construct(StoreNavigationItemTask $storeNavigationItemTask, AuthorizeActionTask $authorizeActionTask)
    {
        $this->storeNavigationItemTask = $storeNavigationItemTask;
        $this->authorizeActionTask     = $authorizeActionTask;
    }

    public function run(StoreRequest $request)
    {
        $this->authorizeActionTask->run('create', Item::class);

        $itemData = [
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid,
            'icon'         => $request->post('icon'),
            'title'        => $request->post('title'),
            'href'         => $request->post('href'),
        ];

        return $this->storeNavigationItemTask->run($itemData);
    }
}