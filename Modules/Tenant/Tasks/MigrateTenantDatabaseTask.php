<?php

namespace Modules\Tenant\Tasks;

use Modules\Tenant\Models\TenantDatabase;

/**
 * Class MigrateTenantDatabaseTask
 * @package Modules\Tenant\Tasks
 */
class MigrateTenantDatabaseTask
{
    /**
     * @param TenantDatabase $tenantDatabase
     * @return bool
     */
    public function run(TenantDatabase $tenantDatabase)
    {
        config()->set('database.connections.' . $tenantDatabase->connection, [
            'driver'      => 'mysql',
            'host'        => $tenantDatabase->hostname,
            'port'        => $tenantDatabase->port,
            'database'    => $tenantDatabase->database,
            'username'    => $tenantDatabase->username,
            'password'    => $tenantDatabase->password,
            'unix_socket' => '',
            'charset'     => 'utf8mb4',
            'collation'   => 'utf8mb4_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null
        ]);

        \Artisan::call('migrate', ['--database' => $tenantDatabase->connection]);

        $tenantDatabase->schema_created = true;

        return $tenantDatabase->save();
    }
}