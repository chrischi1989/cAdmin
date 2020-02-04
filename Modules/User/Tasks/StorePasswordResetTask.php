<?php

namespace Modules\User\Tasks;

use Modules\User\Models\PasswordReset;
use Modules\User\Models\User;
use Ramsey\Uuid\Uuid;
use Str;

class StorePasswordResetTask
{
    private $passwordReset;

    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    public function run(User $user) {
        session(['password_reset_token' => Str::random()]);

        $this->passwordReset->uuid         = Uuid::uuid4();
        $this->passwordReset->user_uuid    = $user->uuid;
        $this->passwordReset->created_uuid = $user->uuid;
        $this->passwordReset->updated_uuid = $user->uuid;
        $this->passwordReset->token        = session('password_reset_token');
        $this->passwordReset->token_until  = now()->addDays(1);

        return $this->passwordReset->save();
    }
}
