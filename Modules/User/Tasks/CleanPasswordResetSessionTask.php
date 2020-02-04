<?php

namespace Modules\User\Tasks;

/**
 * Class CleanPasswordResetSessionTask
 * @package Modules\User\Tasks
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
