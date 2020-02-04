<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\ResetPasswordPageAction;
use Modules\User\UI\Web\Requests\ResetPasswordPageRequest;

class ResetPasswordPageHandler
{
    private $resetPasswordPageAction;

    public function __construct(ResetPasswordPageAction $resetPasswordPageAction)
    {
        $this->resetPasswordPageAction = $resetPasswordPageAction;
    }

    public function __invoke(ResetPasswordPageRequest $request, $token)
    {
        $this->resetPasswordPageAction->run($token);

        return view('User.UI.Web.Views.reset-password', [
            'token' => $token
        ]);
    }
}
