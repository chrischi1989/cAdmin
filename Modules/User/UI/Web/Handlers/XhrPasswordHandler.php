<?php

namespace Modules\User\UI\Web\Handlers;

use Helpers;

class XhrPasswordHandler
{
    public function __invoke()
    {
        return response()->json(['password' => Helpers::generatePassword()]);
    }
}
