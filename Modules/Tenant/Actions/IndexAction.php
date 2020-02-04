<?php

namespace Modules\Tenant\Actions;

use Modules\Tenant\Models\Tenant;
use Modules\Tenant\Tasks\FindTenantTask;
use Modules\User\Tasks\AuthorizeActionTask;

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

        return $this->findTenantTask->run(['database']);
    }
}
