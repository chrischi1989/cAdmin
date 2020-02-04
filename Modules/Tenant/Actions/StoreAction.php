<?php

namespace Modules\Tenant\Actions;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Models\TenantDatabase;
use Modules\Tenant\Tasks\StoreTenantDatabaseTask;
use Modules\Tenant\Tasks\StoreTenantTask;
use Modules\Tenant\UI\Web\Requests\StoreRequest;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class StoreAction
 * @package Modules\Tenant\Actions
 */
class StoreAction
{
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;
    /**
     * @var StoreTenantTask
     */
    private $storeTenantTask;
    /**
     * @var StoreTenantDatabaseTask
     */
    private $storeTenantDatabaseTask;

    /**
     * StoreAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param StoreTenantTask $storeTenantTask
     * @param StoreTenantDatabaseTask $storeTenantDatabaseTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        StoreTenantTask $storeTenantTask,
        StoreTenantDatabaseTask $storeTenantDatabaseTask
    ) {
        $this->authorizeActionTask       = $authorizeActionTask;
        $this->storeTenantTask           = $storeTenantTask;
        $this->storeTenantDatabaseTask   = $storeTenantDatabaseTask;
    }

    /**
     * @param StoreRequest $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(StoreRequest $request)
    {
        $this->authorizeActionTask->run('create', Tenant::class);

        $tenantData         = $this->prepareTenantData($request);
        $tenantDatabaseData = $this->prepareTenantDatabaseData($request);

        $tenant = $this->storeTenantTask->run($tenantData);
        if(!$tenant instanceof Tenant) {
            return false;
        }

        $tenantDatabase = $this->storeTenantDatabaseTask->run($tenant, $tenantDatabaseData);
        if(!$tenantDatabase instanceof TenantDatabase) {
            return false;
        }

        return true;
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    private function prepareTenantData(StoreRequest $request)
    {
        return [
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid,
            'user_quota'   => $request->post('user_quota'),
            'tenant'       => $request->post('tenant'),
            'street'       => $request->post('street'),
            'housenumber'  => $request->post('housenumber'),
            'postalcode'   => $request->post('postalcode'),
            'location'     => $request->post('location'),
            'email'        => $request->post('email'),
            'telephone'    => $request->post('telephone'),
            'mobile'       => $request->post('mobile'),
            'website'      => $request->post('website')
        ];
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    private function prepareTenantDatabaseData(StoreRequest $request)
    {
        return [
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid,
            'connection'   => $request->post('connection'),
            'hostname'     => $request->post('hostname'),
            'username'     => $request->post('username'),
            'password'     => $request->post('password'),
            'database'     => $request->post('database'),
            'port'         => $request->post('port')
        ];
    }
}
