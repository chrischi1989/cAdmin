<?php

namespace psnXT\Modules\User\Tasks;

use Carbon\Carbon;
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
     * @throws \Exception
     */
    public function run($data = [])
    {
        $this->user->uuid             = Uuid::uuid4();
        $this->user->tenant_uuid      = $data['tenant_uuid'] ?? null;
        $this->user->created_uuid     = $data['created_uuid'] ?? $this->user->uuid;
        $this->user->updated_uuid     = $data['updated_uuid'] ?? $this->user->uuid;
        $this->user->activated_at     = $data['activated_at'] ?? null;
        $this->user->activated_uuid   = $data['activated_uuid'] ?? null;
        $this->user->deactivated_at   = $data['deactivated_at'] ?? null;
        $this->user->deactivated_uuid = $data['deactivated_uuid'] ?? null;
        $this->user->lastlogin_at     = $data['lastlogin_at'] ?? null;
        $this->user->email            = $data['email'];
        $this->user->

        return $this->user->save();
    }
}
