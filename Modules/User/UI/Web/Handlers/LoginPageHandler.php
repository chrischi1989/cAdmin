<?php

namespace Modules\User\UI\Web\Handlers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\User\Actions\LoginPageAction;

/**
 * Class LoginPageHandler
 * @package Modules\User\UI\Web\Handlers
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function __invoke(Request $request)
    {
        if(!$this->loginPageAction->run()) {
            return view('user::login', [
                'loginDelay' => session()->has('login_attempts') ? session('login_delay') - now()->diffInSeconds(session('login_last_attempt')) : 0
            ]);
        }

        return redirect()->route('dashboard');
    }
}
