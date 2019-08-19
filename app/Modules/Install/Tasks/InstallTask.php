<?php

namespace psnXT\Modules\Install\Tasks;

use Artisan;

/**
 * Class InstallTask
 * @package psnXT\Modules\Install\Tasks
 */
class InstallTask
{
    /**
     * @param array $settings
     * @return bool
     */
    public function run($settings = [])
    {
        Artisan::call('key:generate');
        Artisan::call('storage:link');

        return true;
    }
}
