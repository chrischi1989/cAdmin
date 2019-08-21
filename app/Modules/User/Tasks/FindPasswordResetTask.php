<?php

namespace psnXT\Modules\User\Tasks;

use Illuminate\Database\Eloquent\Collection;
use psnXT\Modules\User\Models\PasswordReset;

/**
 * Class FindPasswordResetTask
 * @package psnXT\Modules\User\Tasks
 */
class FindPasswordResetTask
{
    /**
     * @var PasswordReset
     */
    private $passwordReset;
    /**
     * @var
     */
    private $query;

    /**
     * FindPasswordResetTask constructor.
     * @param PasswordReset $passwordReset
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    /**
     * @param array $with
     * @return Collection
     */
    public function run($with = [])
    {
        return $this->query->with($with)->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return PasswordReset
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->passwordReset->where('uuid', $uuid);

        return $this->run($with)->first();
    }

    /**
     * @param $userUuid
     * @param array $with
     * @return PasswordReset
     */
    public function byUserUuid($userUuid, $with = [])
    {
        $this->query = $this->passwordReset->where('user_uuid', $userUuid);

        return $this->run($with)->first();
    }

    /**
     * @param $token
     * @param array $with
     * @return PasswordReset
     */
    public function byToken($token, $with = [])
    {
        $this->query = $this->passwordReset->where('token', $token);

        return $this->run($with)->first();
    }
}
