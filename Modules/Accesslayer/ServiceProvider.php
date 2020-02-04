<?php

namespace Modules\Accesslayer;

use Illuminate\Contracts\Auth\Access\Gate;
use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\Policies\AccesslayerPolicy;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'Accesslayer');

        $gate->policy(Layer::class, AccesslayerPolicy::class);
    }
}
