<?php

namespace psnXT\Modules\Setting\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\Setting\Models\Setting;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'settings');
    }

    public function __invoke()
    {
        $this->authorize('show', Setting::class);

        return view('setting::index');
    }
}
