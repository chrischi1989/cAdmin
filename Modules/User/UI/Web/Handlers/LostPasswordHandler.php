<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\LostPasswordAction;
use Modules\User\UI\Web\Requests\LostPasswordRequest;

class LostPasswordHandler
{
    private $lostPasswordAction;

    public function __construct(LostPasswordAction $lostPasswordAction)
    {
        $this->lostPasswordAction = $lostPasswordAction;
    }

    public function __invoke(LostPasswordRequest $request)
    {
        return $this->lostPasswordAction->run($request) ? $request->success() : $request->failed();
    }
}
