<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\UpdateAction;
use psnXT\Modules\User\UI\Web\Requests\UpdateRequest;

/**
 * Class UpdateHandler
 * @package psnXT\Modules\User\UI\Web\Handlers
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
