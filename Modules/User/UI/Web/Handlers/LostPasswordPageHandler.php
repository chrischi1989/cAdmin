<?php

namespace Modules\User\UI\Web\Handlers;

use Illuminate\Http\Request;

class LostPasswordPageHandler
{
    public function __invoke(Request $request)
    {
        return view('User.UI.Web.Views.lost-password', [
            'resetDelay' => session()->has('reset_attempts') ? session('reset_delay') - now()->diffInSeconds(session('reset_last_attempt')) : 0
        ]);
    }
}
