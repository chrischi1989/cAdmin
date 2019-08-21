<?php

namespace psnXT\Modules\User\Tasks;

/**
 * Class CleanPasswordResetSessionTask
 * @package psnXT\Modules\User\Tasks
 */
class CleanPasswordResetSessionTask
{
    /**
     * @return bool
     */
    public function run()
    {
        session()->forget([
            'reset_attempts',
            'reset_delay',
            'reset_last_attempt'
        ]);

        return true;
    }
}
