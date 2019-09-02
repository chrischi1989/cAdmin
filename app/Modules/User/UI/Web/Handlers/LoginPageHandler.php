<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use Illuminate\Http\Request;
use psnXT\Modules\User\Actions\LoginPageAction;

/**
 * Class LoginPageHandler
 * @package psnXT\Modules\User\UI\Web\Handlers
 */
class LoginPageHandler
{
    private $loginPageAction;

    public function __construct(LoginPageAction $loginPageAction)
    {
        $this->loginPageAction = $loginPageAction;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        if (!$this->loginPageAction->run()) {
            return view('user::login', [
                'loginDelay' => session()->has('login_attempts') ? session('login_delay') - now()->diffInSeconds(session('login_last_attempt')) : 0
            ]);
        }

        return redirect()->route('dashboard');
    }
}
