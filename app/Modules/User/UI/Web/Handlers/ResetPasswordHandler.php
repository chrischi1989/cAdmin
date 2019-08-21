<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\ResetPasswordAction;
use psnXT\Modules\User\UI\Web\Requests\ResetPasswordRequest;

class ResetPasswordHandler
{
    private $resetPasswordAction;

    public function __construct(ResetPasswordAction $resetPasswordAction)
    {
        $this->resetPasswordAction = $resetPasswordAction;
    }

    public function __invoke(ResetPasswordRequest $request)
    {
        return $this->resetPasswordAction->run($request) ? $request->success() : $request->failed();
    }
}
