<?php

namespace Modules\User\Tasks;

use Modules\User\Models\PasswordReset;

/**
 * Class DestroyPasswordResetTask
 * @package Modules\User\Tasks
 */
class DestroyPasswordResetTask
{
    /**
     * @param PasswordReset $passwordReset
     * @return bool|null
     * @throws \Exception
     */
    public function run(PasswordReset $passwordReset)
    {
        return $passwordReset->delete();
    }
}
