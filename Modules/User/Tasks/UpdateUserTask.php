<?php

namespace Modules\User\Tasks;

use Modules\User\Models\User;

/**
 * Class UpdateUserTask
 * @package Modules\User\Tasks
 */
class UpdateUserTask
{
    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function run(User $user, $data = [])
    {
        $user->tenant_uuid           = $data['tenant_uuid'] ?? $user->tenant_uuid;
        $user->updated_uuid          = $data['updated_uuid'] ?? $user->updated_uuid;
        $user->activated_at          = $data['activated_at'] ?? $user->activated_at;
        $user->activated_uuid        = $data['activated_uuid'] ?? $user->activated_uuid;
        $user->deactivated_at        = $data['deactivated_at'] ?? $user->deactivated_at;
        $user->deactivated_uuid      = $data['deactivated_uuid'] ?? $user->deactivated_uuid;
        $user->lastlogin_at          = $data['lastlogin_at'] ?? $user->lastlogin_at;
        $user->email_hashed          = $data['email'] ?? $user->email_hashed;
        $user->email_encrypted       = $data['email'] ?? $user->email_encrypted;
        $user->password              = $data['password'] ?? $user->password;
        $user->activation_token      = $data['activation_token'] ?? $user->activation_token;
        $user->failed_logins         = $data['failed_logins'] ?? $user->failed_logins;
        $user->failed_logins_max     = $data['failed_logins_max'] ?? $user->failed_logins_max;
        $user->password_expires      = $data['password_expires'] ?? $user->password_expires;
        $user->password_expires_days = $data['password_expires_days'] ?? $user->password_expires_days;

        return $user->save();
    }
}
