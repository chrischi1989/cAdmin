<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\PasswordReset;

/**
 * Class DestroyPasswordResetTask
 * @package psnXT\Modules\User\Tasks
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
