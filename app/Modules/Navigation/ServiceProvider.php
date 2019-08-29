<?php

namespace psnXT\Modules\Navigation;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use psnXT\Modules\Navigation\Models\Item;
use psnXT\Modules\Navigation\Policies\NavigationPolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'navigation');

        $gate->policy(Item::class, NavigationPolicy::class);
    }
}
