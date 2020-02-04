<?php

namespace Modules\Tenant\Tasks;

use Modules\Tenant\Models\TenantDatabase;

/**
 * Class SeedTenantDatabaseTask
 * @package Modules\Tenant\Tasks
 */
class SeedTenantDatabaseTask
{
    /**
     * @param TenantDatabase $tenantDatabase
     * @return int
     */
    public function run(TenantDatabase $tenantDatabase)
    {
        $seedOrder = [
            'Dashboard',
            'Module',
            'Navigation',
            'Setting',
            'User',
            'Accesslayer'
        ];

        foreach($seedOrder as $module) {
            $this->recursiveSeed($module, $tenantDatabase);
        }

        \DB::connection($tenantDatabase->connection)->statement('DROP TABLE users_password_resets');
        \DB::connection($tenantDatabase->connection)->statement('DROP TABLE tenants');
        \DB::connection($tenantDatabase->connection)->statement('DROP TABLE tenants_databases');

        return true;
    }

    private function recursiveSeed($module, TenantDatabase $tenantDatabase) {
        if(file_exists(base_path('Modules/' . $module . '/Data/Seeders/DatabaseSeeder.php'))) {
            \Artisan::call('db:seed', [
                '--class' => 'Modules\\' . $module . '\Data\Seeders\DatabaseSeeder',
                '--database' => $tenantDatabase->connection
            ]);
        }

        if(is_dir(base_path('Modules/' . $module . '/Modules'))) {
            foreach(scandir(base_path('Modules/' . $module . '/Modules')) as $subModule) {
                $this->recursiveSeed($module . '/Modules/' . $subModule, $tenantDatabase);
            }
        }
    }
}