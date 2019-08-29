<?php

namespace psnXT\Modules\Accesslayer;

use Illuminate\Contracts\Auth\Access\Gate;
use psnXT\Modules\Accesslayer\Models\Layer;
use psnXT\Modules\Accesslayer\Policies\AccesslayerPolicy;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'accesslayer');

        $gate->policy(Layer::class, AccesslayerPolicy::class);
    }
}
