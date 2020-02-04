<?php

namespace Modules\Tenant\Tasks;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Models\TenantDatabase;

/**
 * Class StoreTenantDatabaseTask
 * @package Modules\Tenant\Tasks
 */
class StoreTenantDatabaseTask
{
    /**
     * @var TenantDatabase
     */
    private $tenantDatabase;

    /**
     * StoreTenantDatabaseTask constructor.
     * @param TenantDatabase $tenantDatabase
     */
    public function __construct(TenantDatabase $tenantDatabase)
    {
        $this->tenantDatabase = $tenantDatabase;
    }

    /**
     * @param Tenant $tenant
     * @param array $data
     * @return bool
     */
    public function run(Tenant $tenant, $data = [])
    {
        $this->tenantDatabase->tenant_uuid  = $tenant->uuid;
        $this->tenantDatabase->created_uuid = $data['created_uuid'];
        $this->tenantDatabase->updated_uuid = $data['updated_uuid'];
        $this->tenantDatabase->connection   = $data['connection'];
        $this->tenantDatabase->hostname     = $data['hostname'];
        $this->tenantDatabase->username     = $data['username'];
        $this->tenantDatabase->password     = $data['password'];
        $this->tenantDatabase->database     = $data['database'];
        $this->tenantDatabase->port         = $data['port'] ?? 3306;

        return $this->tenantDatabase->save();
    }
}