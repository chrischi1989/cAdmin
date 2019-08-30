<?php

namespace psnXT\Modules\Tenant;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use psnXT\Modules\Tenant\Models\Tenant;
use psnXT\Modules\Tenant\Policies\TenantPolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'tenant');

        $gate->policy(Tenant::class, TenantPolicy::class);
    }
}
