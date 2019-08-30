<?php

namespace psnXT\Modules\Tenant\Actions;

use psnXT\Modules\Tenant\Models\Tenant;
use psnXT\Modules\Tenant\Tasks\FindTenantTask;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;

class IndexAction
{
    private $authorizeActionTask;
    private $findTenantTask;

    public function __construct(AuthorizeActionTask $authorizeActionTask, FindTenantTask $findTenantTask)
    {
        view()->share('active', 'tenant');

        $this->findTenantTask      = $findTenantTask;
        $this->authorizeActionTask = $authorizeActionTask;
    }

    public function run() {
        $this->authorizeActionTask->run('show', Tenant::class);

        return $this->findTenantTask->run();
    }
}
