<?php

namespace psnXT\Modules\Setting;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use psnXT\Modules\Setting\Models\Setting;
use psnXT\Modules\Setting\Policies\SettingPolicy;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {

    }

    public function boot(Gate $gate)
    {
        $this->loadRoutesFrom(__DIR__ . '/module.php');

        $this->loadMigrationsFrom(__DIR__ . '/Data/Migrations');

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'setting');

        $gate->policy(Setting::class, SettingPolicy::class);
    }
}
