<?php

namespace Modules\Setting\UI\Web\Handlers;

use App\Controller;
use Modules\Setting\Actions\IndexAction;

class IndexHandler extends Controller
{
    private $indexAction;

    public function __construct(IndexAction $indexAction)
    {
        $this->indexAction = $indexAction;
    }

    public function __invoke()
    {
        $settings = $this->indexAction->run();

        return view('Setting::index', [
            'settings' => $settings
        ]);
    }
}
