<?php

namespace Modules\Page\UI\Web\Handlers;

class PageHandler
{
    public function __invoke()
    {
        return view('welcome');
    }
}
