<?php

namespace psnXT\Modules\Module;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use psnXT\Modules\Module\Models\Module;
use psnXT\Modules\Module\Policies\ModulePolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'module');

        $gate->policy(Module::class, ModulePolicy::class);
    }
}
