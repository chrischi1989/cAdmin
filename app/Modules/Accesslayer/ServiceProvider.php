<?php

namespace psnXT\Modules\Accesslayer;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'accesslayer');
    }
}
