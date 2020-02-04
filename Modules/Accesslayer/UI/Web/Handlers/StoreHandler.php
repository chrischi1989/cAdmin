<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use App\Controller;
use Modules\Accesslayer\Actions\StoreAction;
use Modules\Accesslayer\UI\Web\Requests\StoreRequest;

/**
 * Class StoreHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
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
     * @throws \Exception
     */
    public function __invoke(StoreRequest $request)
    {
        return $this->storeAction->run($request) ? $request->success() : $request->failed();
    }
}
