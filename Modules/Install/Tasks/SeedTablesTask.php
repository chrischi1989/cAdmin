<?php

namespace Modules\Install\Tasks;

use Artisan;

/**
 * Class SeedTablesTask
 * @package Modules\Install\Tasks
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
            if(file_exists(base_path('Modules/' . $module . '/Data/Seeders/DatabaseSeeder.php'))) {
                Artisan::call('db:seed', ['--class' => 'Modules\\' . $module . '\Data\Seeders\DatabaseSeeder']);
            }
        }

        return true;
    }
}
