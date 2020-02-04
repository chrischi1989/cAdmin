<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\UpdateAction;
use Modules\User\UI\Web\Requests\UpdateRequest;

/**
 * Class UpdateHandler
 * @package Modules\User\UI\Web\Handlers
 */
class UpdateHandler
{
    /**
     * @var UpdateAction
     */
    private $updateAction;

    /**
     * UpdateHandler constructor.
     * @param UpdateAction $updateAction
     */
    public function __construct(UpdateAction $updateAction)
    {
        $this->updateAction = $updateAction;
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(UpdateRequest $request)
    {
        return $this->updateAction->run($request) ? $request->success() : $request->failed();
    }
}
