<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\User;
use Ramsey\Uuid\Uuid;

/**
 * Class StoreUserTask
 * @package app\Modules\User\Tasks
 */
class StoreUserTask
{
    /**
     * @var User
     */
    private $user;

    /**
     * StoreUserTask constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function run($data = [])
    {
        $this->user->tenant_uuid           = $data['tenant_uuid'] ?? null;
        $this->user->created_uuid          = $data['created_uuid'] ?? $this->user->uuid;
        $this->user->updated_uuid          = $data['updated_uuid'] ?? $this->user->uuid;
        $this->user->activated_at          = $data['activated_at'] ?? null;
        $this->user->activated_uuid        = $data['activated_uuid'] ?? (!is_null($this->user->activated_at ? $this->user->uuid : null));
        $this->user->deactivated_at        = $data['deactivated_at'] ?? null;
        $this->user->deactivated_uuid      = $data['deactivated_uuid'] ?? null;
        $this->user->lastlogin_at          = $data['lastlogin_at'] ?? null;
        $this->user->email_hashed          = $data['email'];
        $this->user->email_encrypted       = $data['email'];
        $this->user->password              = $data['password'];
        $this->user->activation_token      = $data['activation_token'] ?? null;
        $this->user->failed_logins         = $data['failed_logins'] ?? 0;
        $this->user->failed_logins_max     = $data['failed_logins_max'] ?? 5;
        $this->user->password_expires      = $data['password_expires'] ?? true;
        $this->user->password_expires_days = $data['password_expires_days'] ?? 90;

        return $this->user->save();
    }
}
