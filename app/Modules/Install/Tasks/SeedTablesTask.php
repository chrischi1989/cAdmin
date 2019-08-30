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
        $seedOrder = [
            'Dashboard',
            'Install',
            'Module',
            'Navigation',
            'Page',
            'Setting',
            'Tenant',
            'User',
            'Accesslayer'
        ];

        foreach($seedOrder as $module) {
            if(file_exists(app_path('Modules/' . $module . '/Data/Seeders/DatabaseSeeder.php'))) {
                Artisan::call('db:seed', ['--class' => 'psnXT\Modules\\' . $module . '\Data\Seeders\DatabaseSeeder']);
            }
        }

        return true;
    }
}
