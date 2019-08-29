<?php

namespace psnXT\Modules\Module\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\Module\Models\Module;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'modules');
    }

    public function __invoke()
    {
        $this->authorize('show', Module::class);

        return view('module::index');
    }
}
