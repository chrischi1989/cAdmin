<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\ResetPasswordPageAction;
use psnXT\Modules\User\UI\Web\Requests\ResetPasswordPageRequest;

class ResetPasswordPageHandler
{
    private $resetPasswordPageAction;

    public function __construct(ResetPasswordPageAction $resetPasswordPageAction)
    {
        $this->resetPasswordPageAction = $resetPasswordPageAction;
    }

    public function __invoke(ResetPasswordPageRequest $request, $token)
    {
        $result = $this->resetPasswordPageAction->run($token);

        return view('User.UI.Web.Views.reset-password', [
            'token' => $token
        ]);
    }
}
