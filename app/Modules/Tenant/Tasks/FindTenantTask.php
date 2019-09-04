<?php

namespace psnXT\Modules\Tenant\Tasks;

use psnXT\Modules\Tenant\Models\Tenant;

/**
 * Class FindTenantTask
 * @package psnXT\Modules\Tenant\Tasks
 */
class FindTenantTask
{
    /**
     * @var
     */
    private $query;
    /**
     * @var Tenant
     */
    private $tenant;

    /**
     * FindTenantTask constructor.
     * @param Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * @param array $with
     * @return mixed
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->tenant->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->tenant->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }
}
