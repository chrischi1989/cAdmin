<?php

namespace psnXT\Modules\Dashboard\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\Dashboard\Models\Dashboard;

class IndexHandler extends Controller
{
    public function __invoke()
    {
        $this->authorize('show', Dashboard::class);

        return view('dashboard::index');
    }
}
