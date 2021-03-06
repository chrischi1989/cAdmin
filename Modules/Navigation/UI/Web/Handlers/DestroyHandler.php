<?php

namespace Modules\Navigation\UI\Web\Handlers;

use Modules\Navigation\Actions\DestroyAction;
use Modules\Navigation\UI\Web\Requests\DestroyRequest;

/**
 * Class DestroyHandler
 * @package Modules\Navigation\UI\Web\Handlers
 */
class DestroyHandler
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
     */
    public function __invoke(DestroyRequest $request)
    {
        return $this->destroyAction->run($request) ? $request->success() : $request->failed();
    }
}
