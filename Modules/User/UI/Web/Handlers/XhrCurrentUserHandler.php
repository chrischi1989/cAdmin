<?php

namespace Modules\User\UI\Web\Handlers;

class XhrCurrentUserHandler
{
    public function __invoke()
    {
        return response()->json(auth()->user());
    }
}