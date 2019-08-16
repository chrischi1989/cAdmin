<?php

namespace app\Modules\User\Tasks;

use psnXT\Modules\User\Models\User;

class FindUserTask
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run($with = []) {
        return $this->user->with($with)->get();
    }

    public function byUuid($uuid, $with = []) {
        $this->user->where('uuid', $uuid);

        return $this->run($with);
    }

    public function byEmail($email, $with = []) {
        $this->user->where('email', $email);

        return $this->run($with);
    }
}
