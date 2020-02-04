<?php

namespace Modules\User\Actions;

/**
 * Class LoginPageAction
 * @package Modules\User\Actions
 */
class LoginPageAction
{
    /**
     * @return bool
     */
    public function run()
    {
        return auth()->check();
    }
}
