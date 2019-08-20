<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use app\Modules\User\Actions\LoginDelayAction;
use Illuminate\Http\Request;

class LoginPageHandler
{
    private $loginDelayAction;

    public function __construct(LoginDelayAction $loginDelayAction)
    {
        $this->loginDelayAction = $loginDelayAction;
    }

    public function __invoke(Request $request)
    {
        $loginDelay = $this->loginDelayAction->run($request);

        return view('User.UI.Web.Views.login', [
            'loginDelay' => $loginDelay
        ]);
    }
}
