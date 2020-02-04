<?php

namespace Modules\Tenant\Actions;

use Modules\Tenant\Models\Tenant;
use Modules\User\Tasks\AuthorizeActionTask;

class CreateAction
{
    private $authorizeActionTask;

    public function __construct(AuthorizeActionTask $authorizeActionTask)
    {
        view()->share('active', 'tenant');

        $this->authorizeActionTask = $authorizeActionTask;
    }

    public function run()
    {
        $this->authorizeActionTask->run('create', Tenant::class);
    }
}