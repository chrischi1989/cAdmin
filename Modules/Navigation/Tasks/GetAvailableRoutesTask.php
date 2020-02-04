<?php

namespace Modules\Navigation\Tasks;

use Route;

/**
 * Class GetAvailableRoutesTask
 * @package Modules\Navigation\Tasks
 */
class GetAvailableRoutesTask
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function run()
    {
        $availableRoutes = collect(Route::getRoutes())->filter(function ($route) {
            return strpos($route->uri, '_debugbar') === false &&
            strpos($route->uri, 'captcha') === false &&
            strpos($route->uri, '{') === false &&
            in_array('GET', $route->methods) ? $route : null;

        })->sortBy('uri');

        return $availableRoutes;
    }
}
