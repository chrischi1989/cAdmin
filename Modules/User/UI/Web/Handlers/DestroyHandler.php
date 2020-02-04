<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\DestroyAction;
use Modules\User\UI\Web\Requests\DestroyRequest;

class DestroyHandler
{
    private $destroyAction;

    public function __construct(DestroyAction $destroyAction)
    {
        $this->destroyAction = $destroyAction;
    }

    public function __invoke(DestroyRequest $request)
    {
        return $this->destroyAction->run($request) ? $request->success() : $request->failed();
    }
}
