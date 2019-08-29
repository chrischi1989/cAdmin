<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

class UnauthorizedPageHandler
{
    public function __invoke()
    {
        return view('user::unauthorized');
    }
}
