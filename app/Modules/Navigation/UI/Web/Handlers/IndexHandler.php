<?php

namespace psnXT\Modules\Navigation\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\Navigation\Models\Item;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'navigation');
    }

    public function __invoke()
    {
        $this->authorize('show', Item::class);

        return view('navigation::index');
    }
}
