<?php

namespace psnXT\Modules\Setting;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'setting');
    }
}
