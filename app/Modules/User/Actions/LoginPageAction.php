<?php

namespace psnXT\Modules\User\Actions;

/**
 * Class LoginPageAction
 * @package psnXT\Modules\User\Actions
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
