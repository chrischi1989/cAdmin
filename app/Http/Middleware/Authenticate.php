<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Accesslayer\Models\Layer;
use Modules\Module\Models\ModulePermission;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $permissions = collect();
        $currentUser = $request->user();
        $currentUser->load(['accesslayers.permissions.module', 'profile']);
        $currentUser->priority = $currentUser->accesslayers->max('priority');
        $currentUser->accesslayers->map(function(Layer $layer) use(&$permissions) {
            $layer->permissions->map(function(ModulePermission $permission) use(&$permissions) {
                $module = strtolower($permission->module->module);

                $permissions->has($module) ? $permissions->get($module)->push($permission->permission) : $permissions->put($module, collect($permission->permission));
            });
        });

        $currentUser->permissions = $permissions;
        view()->share('currentUser', $currentUser);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('user-login-page');
        }
    }
}
