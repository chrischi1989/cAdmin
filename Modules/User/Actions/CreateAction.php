<?php

namespace Modules\User\Actions;

use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Tenant\Tasks\FindTenantTask;
use Modules\User\Models\User;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class CreateAction
 * @package Modules\User\Actions
 */
class CreateAction
{
    /**
     * @var FindTenantTask
     */
    private $findTenantTask;
    /**
     * @var
     */
    private $findLayerTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * CreateAction constructor.
     * @param FindTenantTask $findTenantTask
     * @param FindLayerTask $findLayerTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindTenantTask $findTenantTask,
        FindLayerTask $findLayerTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findTenantTask      = $findTenantTask;
        $this->findLayerTask       = $findLayerTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'user');
    }

    /**
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('create', User::class);

        return [
            'tenants'     => is_null(request()->user()->tenant_uuid) ? $this->findTenantTask->run() : null,
            'accesslayer' => $this->findLayerTask->run()
        ];
    }
}
