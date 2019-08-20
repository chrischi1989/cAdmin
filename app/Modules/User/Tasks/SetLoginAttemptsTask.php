<?php

namespace app\Modules\User\Tasks;

class SetLoginAttemptsTask
{
    public function run() {
        return session('login_attempts') + 1;
    }
}
