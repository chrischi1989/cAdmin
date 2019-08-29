<?php

namespace psnXT\Modules\User\Tasks;

use psnXT\Modules\User\Models\User;

class SetLoginAttemptsTask
{
    public function run($user = null) {
        session([
            'login_attempts'     => session()->has('login_attempts') ? session('login_attempts') + 1 : 1,
            'login_last_attempt' => now()
        ]);

        if(!$user instanceof User) {
            return true;
        }

        if($user->failed_logins + 1 > $user->failed_logins_max) {
            if(!is_null($user->deactivated_at)) {
                return true;
            }

            $user->deactivated_at   = now();
            $user->deactivated_uuid = $user->uuid;
        } else {
            $user->failed_logins++;
        }

        return $user->save();
    }
}
