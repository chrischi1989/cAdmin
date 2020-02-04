<?php

namespace Modules\Dashboard\UI\Web\Handlers;

use App\Controller;
use Modules\Dashboard\Models\Dashboard;

class IndexHandler extends Controller
{
    public function __construct()
    {
        view()->share('active', 'dashboard');
    }

    public function __invoke()
    {
        $this->authorize('show', Dashboard::class);

        return view('dashboard::index');
    }
}
