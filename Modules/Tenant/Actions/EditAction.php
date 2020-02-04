<?php

namespace Modules\Tenant\Actions;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Tasks\FindTenantDatabaseTask;
use Modules\Tenant\Tasks\FindTenantTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class EditAction
 * @package Modules\Tenant\Actions
 */
class EditAction
{
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;
    /**
     * @var FindTenantTask
     */
    private $findTenantTask;
    /**
     * @var FindTenantDatabaseTask
     */
    private $findTenantDatabaseTask;

    /**
     * EditAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param FindTenantTask $findTenantTask
     * @param FindTenantDatabaseTask $findTenantDatabaseTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindTenantTask $findTenantTask,
        FindTenantDatabaseTask $findTenantDatabaseTask
    ) {
        view()->share('active', 'tenant');

        $this->authorizeActionTask = $authorizeActionTask;
        $this->findTenantTask      = $findTenantTask;
        $this->findTenantDatabaseTask = $findTenantDatabaseTask;
    }

    /**
     * @param $tenantUuid
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run($tenantUuid)
    {
        $this->authorizeActionTask->run('edit', Tenant::class);

        $tenant = $this->findTenantTask->byUuid($tenantUuid);
        $tenantDatabase = $this->findTenantDatabaseTask->byTenantUuid($tenant->uuid);

        return [
            'tenant' => $tenant,
            'tenantDatabase' => $tenantDatabase
        ];
    }
}