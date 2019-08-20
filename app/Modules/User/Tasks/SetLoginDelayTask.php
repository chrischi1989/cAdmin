<?php


namespace app\Modules\User\Tasks;


class SetLoginDelayTask
{
    public function run() {
        return session('login_delay') - now()->diffInSeconds(session('login_lastattempt'));
    }
}
