<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\User\Models\User;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'user');
    }

    public function __invoke()
    {
        $this->authorize('show', User::class);

        return view('user::index');
    }
}
