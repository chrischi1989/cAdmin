<?php

namespace psnXT\Modules\Navigation;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'navigation');
    }
}