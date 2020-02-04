<?php

namespace App\Http\Middleware;

use Closure;
use Modules\Setting\Models\Setting;

class Settings
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = Setting::with('module')->get();

        /** @var Setting $setting */
        foreach ($settings as $setting) {
            config([$setting->module->module . '.' . $setting->setting => $setting]);
        }

        return $next($request);
    }
}
