<?php

namespace Modules\Tenant\Tasks;

use Modules\Tenant\Models\TenantDatabase;

/**
 * Class FindTenantDatabaseTask
 * @package Modules\Tenant\Tasks
 */
class FindTenantDatabaseTask
{
    /**
     * @var
     */
    private $query;
    /**
     * @var TenantDatabase
     */
    private $tenantDatabase;

    /**
     * FindTenantDatabaseTask constructor.
     * @param TenantDatabase $tenantDatabase
     */
    public function __construct(TenantDatabase $tenantDatabase)
    {
        $this->tenantDatabase = $tenantDatabase;
    }

    /**
     * @param array $with
     * @return mixed
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->tenantDatabase->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->tenantDatabase->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }

    /**
     * @param $tenantUuid
     * @param array $with
     * @return mixed
     */
    public function byTenantUuid($tenantUuid, $with = [])
    {
        $this->query = $this->tenantDatabase->with($with)->where('tenant_uuid', $tenantUuid);

        return $this->run()->first();
    }
}
