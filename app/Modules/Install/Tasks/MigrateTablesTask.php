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
        // In welcher Reihenfolge werden die Datenbanktabellen erstellt
        $order = [
            'Modules',
            'Install',
            'User',
            'Accesslayer',
            'Navigation',
            'Settings',
            'Backup',
            'Dashboard',
            'Media'
        ];

        foreach($order as $module) {
            Artisan::call('migrate --path=app/Modules/' . $module . '/Data/Migrations');
        }

        return true;
    }
}
