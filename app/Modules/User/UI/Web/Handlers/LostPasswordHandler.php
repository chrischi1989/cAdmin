<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\LostPasswordAction;
use psnXT\Modules\User\UI\Web\Requests\LostPasswordRequest;

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
