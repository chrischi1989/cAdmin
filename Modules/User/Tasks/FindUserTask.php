<?php

namespace Modules\User\Tasks;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\User\Models\User;

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
     * @return Builder[]|Collection|User[]
     */
    public function run(array $with = []) {
        return is_null($this->query) ? $this->user->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return User
     */
    public function byUuid($uuid, array $with = []): User
    {
        $this->query = $this->user->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }

    /**
     * @param $email
     * @param array $with
     * @return User
     */
    public function byEmail($email, array $with = []): User
    {
        $this->query = $this->user->with($with)->where('email_hashed', hash('sha512', $email));

        return $this->run()->first();
    }
}
