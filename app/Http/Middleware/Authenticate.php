<?php

namespace psnXT\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $container   = [];
        $currentUser = $request->user()->load(['accesslayer.permissions.module', 'profile']);
        foreach($currentUser->accesslayer as $accesslayer) {
            $request->user()->priority = $accesslayer->priority > $request->user()->priority ? $accesslayer->priority : $request->user()->priority;
            foreach($accesslayer->permissions as $permission) {
                $module = strtolower($permission->module->module);
                $container[$module][] = $permission->permission;
            }
        }

        $permissions = collect();
        foreach($container as $module => $set) {
            $modulePermissions = collect();
            foreach($set as $index => $value) {
                $modulePermissions->put($value, true);
            }
            $permissions->put($module, $modulePermissions);
        }

        $request->user()->permissions = $permissions;

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
        if (! $request->expectsJson()) {
            return route('user-login-page');
        }
    }
}
