<?php

namespace Modules\Setting;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Setting\Models\Setting;
use Modules\Setting\Policies\SettingPolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'Setting');

        $gate->policy(Setting::class, SettingPolicy::class);

        $this->mergeConfigFrom(__DIR__ . '/config.php', 'setting');
    }
}
