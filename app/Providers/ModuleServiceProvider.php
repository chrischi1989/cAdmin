<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (scandir(base_path('Modules')) as $module) {
            if ($module != '.' && $module != '..') {
                $this->app->register("Modules\\$module\ServiceProvider");
            }
        }

    }
}
