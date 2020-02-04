<?php

namespace Modules\Navigation\UI\Web\Handlers;

use Modules\Navigation\Actions\EditAction;
use Modules\Navigation\UI\Web\Requests\EditRequest;

/**
 * Class EditHandler
 * @package Modules\Navigation\UI\Web\Handlers
 */
class EditHandler
{
    /**
     * @var EditAction
     */
    private $editAction;

    /**
     * EditHandler constructor.
     * @param EditAction $editAction
     */
    public function __construct(EditAction $editAction)
    {
        $this->editAction = $editAction;
    }

    /**
     * @param EditRequest $request
     * @param $itemUuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(EditRequest $request, $itemUuid)
    {
        $return = $this->editAction->run($itemUuid);

        return view('navigation::create-edit', [
            'routes' => $return['routes'],
            'item'   => $return['item']
        ]);
    }
}
