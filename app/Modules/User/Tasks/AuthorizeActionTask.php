<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Controller;

/**
 * Class AuthorizeActionTask
 * @package psnXT\Modules\User\Tasks
 */
class AuthorizeActionTask extends Controller
{
    /**
     * @param $ability
     * @param $class
     * @return \Illuminate\Auth\Access\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run($ability, $class)
    {
        return $this->authorize($ability, $class);
    }
}
