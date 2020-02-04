<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\StoreAction;
use Modules\User\UI\Web\Requests\StoreRequest;

/**
 * Class StoreHandler
 * @package Modules\User\UI\Web\Handlers
 */
class StoreHandler
{
    /**
     * @var StoreAction
     */
    private $storeAction;

    /**
     * StoreHandler constructor.
     * @param StoreAction $storeAction
     */
    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(StoreRequest $request)
    {
        return $this->storeAction->run($request) ? $request->success() : $request->failed();
    }
}
