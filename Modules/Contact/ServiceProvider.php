<?php

namespace Modules\Contact;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\User\Policies\UserPolicy;
use Modules\User\Models\User;

class ServiceProvider extends BaseServiceProvider
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

        $this->loadViewsFrom(__DIR__ . '/UI/Web/Views', 'Contact');

        //$gate->policy(User::class, UserPolicy::class);
    }
}
