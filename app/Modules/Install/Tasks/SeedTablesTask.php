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
        $order = [
            'Modules',
            'Install',
            'User',
            'Navigation',
            'Settings',
            'Backup',
            'Dashboard',
            'Media',
            'Accesslayer'
        ];

        foreach($order as $module) {
            Artisan::call('db:seed --path=app/Modules/' . $module . '/Data/Seeders');
        }

        return true;
    }
}
