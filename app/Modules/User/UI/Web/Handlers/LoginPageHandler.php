<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use Illuminate\Http\Request;

/**
 * Class LoginPageHandler
 * @package psnXT\Modules\User\UI\Web\Handlers
 */
class LoginPageHandler
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        return view('User.UI.Web.Views.login', [
            'loginDelay' => session()->has('login_attempts') ? session('login_delay') - now()->diffInSeconds(session('login_last_attempt')) : 0
        ]);
    }
}
