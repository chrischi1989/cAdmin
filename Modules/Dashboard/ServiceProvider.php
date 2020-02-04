<?php

namespace Modules\Dashboard;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Dashboard\Models\Dashboard;
use Modules\Dashboard\Policies\DashboardPolicy;
use Modules\Dashboard\Policies\UserPolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'dashboard');

        $gate->policy(Dashboard::class, DashboardPolicy::class);
    }
}
