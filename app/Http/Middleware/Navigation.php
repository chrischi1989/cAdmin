<?php

namespace psnXT\Http\Middleware;

use Closure;
use psnXT\Modules\Navigation\Models\Item;

class Navigation
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
        $items = Item::with(['childItems'])->whereNull('parent_uuid')->orderBy('position')->get();

        view()->share('navigationsItems', $items);

        return $next($request);
    }
}
