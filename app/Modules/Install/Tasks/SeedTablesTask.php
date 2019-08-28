<?php

namespace psnXT\Modules\Install\Tasks;

use Artisan;

/**
 * Class SeedTablesTask
 * @package psnXT\Modules\Install\Tasks
 */
class SeedTablesTask
{
    /**
     * @return bool
     */
    public function run() {
        foreach(scandir(app_path('Modules')) as $module) {
            if($module != '.' && $module != '..' && file_exists(app_path('Modules/' . $module . '/Data/Seeders/DatabaseSeeder.php'))) {
                Artisan::call('db:seed', ['--class' => 'psnXT\Modules\\' . $module . '\Data\Seeders\DatabaseSeeder']);
            }
        }

        return true;
    }
}
