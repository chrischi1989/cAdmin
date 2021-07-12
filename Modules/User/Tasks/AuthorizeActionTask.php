<?php

namespace Modules\User\Tasks;

use App\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

/**
 * Class AuthorizeActionTask
 * @package Modules\User\Tasks
 */
class AuthorizeActionTask extends Controller
{
    /**
     * @param $ability
     * @param $class
     * @return Response
     * @throws AuthorizationException
     */
    public function run($ability, $class)
    {
        return $this->authorize($ability, $class);
    }
}
