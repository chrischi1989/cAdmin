<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use App\Controller;
use Modules\Accesslayer\Actions\DestroyAction;
use Modules\Accesslayer\UI\Web\Requests\DestroyRequest;

/**
 * Class DestroyHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
 */
class DestroyHandler extends Controller
{
    /**
     * @var DestroyAction
     */
    private $destroyAction;

    /**
     * DestroyHandler constructor.
     * @param DestroyAction $destroyAction
     */
    public function __construct(DestroyAction $destroyAction)
    {
        $this->destroyAction = $destroyAction;
    }

    /**
     * @param DestroyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(DestroyRequest $request)
    {
        return $this->destroyAction->run($request) ? $request->success() : $request->failed();
    }
}
