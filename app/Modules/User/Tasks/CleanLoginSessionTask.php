<?php

namespace psnXT\Modules\User\Tasks;

/**
 * Class CleanLoginSessionTask
 * @package psnXT\Modules\User\Tasks
 */
class CleanLoginSessionTask
{
    /**
     * @return bool
     */
    public function run() {
        session()->forget([
            'login_attempts',
            'login_delay',
            'login_last_attempt'
        ]);

        return true;
    }
}
