<?php

namespace psnXT\Modules\Install\Tasks;

use Artisan;

/**
 * Class MigrateTablesTask
 * @package psnXT\Modules\Install\Tasks
 */
class MigrateTablesTask
{
    /**
     * @return bool
     */
    public function run() {
        $order = [
            'Module',
            'Install',
            'User',
            'Accesslayer',
            'Navigation',
            'Setting',
            'Backup',
            'Dashboard',
            'Media',
            'Tenant'
        ];

        foreach($order as $module) {
            Artisan::call('migrate --path=app/Modules/' . $module . '/Data/Migrations');
        }

        return true;
    }
}
