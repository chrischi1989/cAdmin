<?php

namespace Modules\Tenant\UI\Web\Handlers;

use App\Controller;
use Modules\Tenant\Actions\StoreAction;
use Modules\Tenant\UI\Web\Requests\StoreRequest;

/**
 * Class StoreHandler
 * @package Modules\Tenant\UI\Web\Handlers
 */
class StoreHandler extends Controller
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
