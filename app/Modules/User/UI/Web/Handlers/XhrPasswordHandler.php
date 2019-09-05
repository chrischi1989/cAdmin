<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Helpers;

class XhrPasswordHandler
{
    public function __invoke()
    {
        return response()->json(['password' => Helpers::generatePassword()]);
    }
}
