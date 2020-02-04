<?php

namespace Modules\Access;

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
        if(file_exists(__DIR__ . '/module.php')) {
            $this->loadRoutesFrom(__DIR__ . '/module.php');
        }

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'Access');

        //$gate->policy(Layer::class, AccesslayerPolicy::class);
    }
}
