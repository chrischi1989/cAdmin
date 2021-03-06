<?php

namespace App\Http\Middleware;

use Closure;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!file_exists(base_path() . '/install.lock')) {
            return redirect()->route('setup');
        }

        return $next($request);
    }
}
