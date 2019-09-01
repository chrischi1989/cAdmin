<?php

namespace psnXT\Modules\Navigation\UI\Web\Handlers;

use psnXT\Modules\Navigation\Actions\StoreAction;
use psnXT\Modules\Navigation\UI\Web\Requests\StoreRequest;

/**
 * Class StoreHandler
 * @package psnXT\Modules\Navigation\UI\Web\Handlers
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
     */
    public function __invoke(StoreRequest $request)
    {
        return $this->storeAction->run($request) ? $request->success() : $request->failed();
    }
}
