<?php

namespace psnXT\Modules\Accesslayer\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class AccesslayerPolicy
{
    use HandlesAuthorization;

    public function __call($name, $arguments)
    {

    }
}
