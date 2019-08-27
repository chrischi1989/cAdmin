<?php

namespace psnXT\Modules\Dashboard\UI\Web\Handlers;

class IndexHandler
{
    public function __invoke()
    {
        return view('dashboard::index');
    }
}
