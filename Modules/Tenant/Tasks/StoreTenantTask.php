<?php

namespace Modules\Tenant\Tasks;

use Modules\Tenant\Models\Tenant;

/**
 * Class StoreTenantTask
 * @package Modules\Tenant\Tasks
 */
class StoreTenantTask
{
    /**
     * @var Tenant
     */
    private $tenant;

    /**
     * StoreTenantTask constructor.
     * @param Tenant $tenant
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * @param $data
     * @return bool|Tenant
     */
    public function run($data)
    {
        $this->tenant->created_uuid = $data['created_uuid'];
        $this->tenant->updated_uuid = $data['updated_uuid'];
        $this->tenant->user_quota   = $data['user_quota'];
        $this->tenant->tenant       = $data['tenant'];
        $this->tenant->street       = $data['street'] ?? null;
        $this->tenant->housenumber  = $data['housenumber'] ?? null;
        $this->tenant->postalcode   = $data['postalcode'] ?? null;
        $this->tenant->location     = $data['location'] ?? null;
        $this->tenant->email        = $data['email'];
        $this->tenant->telephone    = $data['telephone'] ?? null;
        $this->tenant->mobile       = $data['mobile'] ?? null;
        $this->tenant->website      = $data['website'] ?? null;

        return $this->tenant->save() ? $this->tenant : false;
    }
}