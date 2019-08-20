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
            'Module',
            'Install',
            'User',
            'Navigation',
            'Setting',
            'Accesslayer'
        ];

        foreach($order as $module) {
            Artisan::call('db:seed', ['--class' => 'psnXT\Modules\\' . $module . '\Data\Seeders\DatabaseSeeder']);
        }

        return true;
    }
}
