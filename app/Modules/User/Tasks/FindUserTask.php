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
        return is_null($this->query) ? $this->user->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return User
     */
    public function byUuid($uuid, $with = []) {
        $this->query = $this->user->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }

    /**
     * @param $email
     * @param array $with
     * @return User
     */
    public function byEmail($email, $with = []) {
        $this->query = $this->user->with($with)->where('email_hashed', hash('sha512', $email));

        return $this->run()->first();
    }
}
