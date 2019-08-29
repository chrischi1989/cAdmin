<?php

namespace psnXT\Modules\Accesslayer\UI\Web\Handlers;

use psnXT\Controller;
use psnXT\Modules\Accesslayer\Models\Layer;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'accesslayer');
    }

    public function __invoke()
    {
        $this->authorize('show', Layer::class);
        return view('accesslayer::index');
    }
}
