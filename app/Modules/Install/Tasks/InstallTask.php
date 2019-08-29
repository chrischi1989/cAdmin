<?php

namespace psnXT\Modules\Install\Tasks;

use Artisan;
use DB;

/**
 * Class InstallTask
 * @package psnXT\Modules\Install\Tasks
 */
class InstallTask
{
    /**
     * @return bool
     */
    public function run()
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('key:generate');
        Artisan::call('storage:link');

        DB::purge();
        DB::reconnect();

        Artisan::call('migrate');

        file_put_contents(base_path() . '/install.lock', '');

        return file_exists(base_path() . '/install.lock');
    }
}
