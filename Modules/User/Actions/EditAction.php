<?php

namespace Modules\User\Actions;

use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Tenant\Tasks\FindTenantTask;
use Modules\User\Models\User;
use Modules\User\Tasks\AuthorizeActionTask;
use Modules\User\Tasks\FindUserTask;

class EditAction
{
    private $findUserTask;
    private $findTenantTask;
    private $findLayerTask;
    private $authorizeActionTask;

    public function __construct(
        FindUserTask $findUserTask,
        FindTenantTask $findTenantTask,
        FindLayerTask $findLayerTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findUserTask        = $findUserTask;
        $this->findTenantTask      = $findTenantTask;
        $this->findLayerTask       = $findLayerTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'user');
    }

    public function run($userUuid)
    {
        $this->authorizeActionTask->run('edit', User::class);

        return [
            'user'        => $this->findUserTask->byUuid($userUuid, ['tenant', 'profile', 'accesslayer']),
            'tenants'     => is_null(request()->user()->tenant_uuid) ? $this->findTenantTask->run() : null,
            'accesslayer' => $this->findLayerTask->run()
        ];
    }
}
