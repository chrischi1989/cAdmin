<?php

namespace Modules\Tenant\Actions;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Tasks\FindTenantDatabaseTask;
use Modules\Tenant\Tasks\MigrateTenantDatabaseTask;
use Modules\Tenant\Tasks\SeedTenantDatabaseTask;
use Modules\Tenant\UI\Web\Requests\DatabaseRequest;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class DatabaseAction
 * @package Modules\Tenant\Actions
 */
class DatabaseAction
{
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;
    /**
     * @var FindTenantDatabaseTask
     */
    private $findTenantDatabaseTask;
    /**
     * @var MigrateTenantDatabaseTask
     */
    private $migrateTenantDatabaseTask;
    /**
     * @var SeedTenantDatabaseTask
     */
    private $seedTenantDatabaseTask;

    /**
     * DatabaseAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param FindTenantDatabaseTask $findTenantDatabaseTask
     * @param MigrateTenantDatabaseTask $migrateTenantDatabaseTask
     * @param SeedTenantDatabaseTask $seedTenantDatabaseTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindTenantDatabaseTask $findTenantDatabaseTask,
        MigrateTenantDatabaseTask $migrateTenantDatabaseTask,
        SeedTenantDatabaseTask $seedTenantDatabaseTask
    ) {
        $this->authorizeActionTask       = $authorizeActionTask;
        $this->findTenantDatabaseTask    = $findTenantDatabaseTask;
        $this->migrateTenantDatabaseTask = $migrateTenantDatabaseTask;
        $this->seedTenantDatabaseTask    = $seedTenantDatabaseTask;
    }

    /**
     * @param DatabaseRequest $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run(DatabaseRequest $request)
    {
        $this->authorizeActionTask->run('create', Tenant::class);

        session()->put('uuid', $request->user()->uuid);
        session()->put('tenant-seed', true);

        $tenantDatabase = $this->findTenantDatabaseTask->byUuid($request->post('uuid'));

        return $this->migrateTenantDatabaseTask->run($tenantDatabase) &&
               $this->seedTenantDatabaseTask->run($tenantDatabase);
    }
}