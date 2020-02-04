<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use Modules\Accesslayer\Actions\EditAction;
use Modules\Accesslayer\UI\Web\Requests\EditRequest;

/**
 * Class EditHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
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
     * @param EditRequest $editRequest
     * @param $layerUuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(EditRequest $editRequest, $layerUuid)
    {
        $return = $this->editAction->run($layerUuid);

        return view('Accesslayer::create-edit', [
            'layer'   => $return['layer'],
            'modules' => $return['modules']
        ]);
    }
}
