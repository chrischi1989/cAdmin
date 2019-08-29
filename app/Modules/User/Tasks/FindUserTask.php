<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\User;

class FindUserTask
{
    private $user;
    private $query;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|User[]
     */
    public function run($with = []) {
        return $this->query->with($with)->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return User
     */
    public function byUuid($uuid, $with = []) {
        $this->query = $this->user->where('uuid', $uuid);

        return $this->run($with)->first();
    }

    /**
     * @param $email
     * @param array $with
     * @return User
     */
    public function byEmail($email, $with = []) {
        $this->query = $this->user->where('email_hashed', hash('sha512', $email));

        return $this->run()->first();
    }
}
