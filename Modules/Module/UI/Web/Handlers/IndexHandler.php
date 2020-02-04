<?php

namespace Modules\Module\UI\Web\Handlers;

use App\Controller;
use Modules\Module\Actions\IndexAction;

class IndexHandler extends Controller
{
    private $indexAction;

    public function __construct(IndexAction $indexAction)
    {
        $this->indexAction = $indexAction;
    }

    public function __invoke()
    {
        $return = $this->indexAction->run();

        return view('Module::index', [
            'installedModules' => $return['installedModules'],
            'availableModules' => $return['availableModules']
        ]);
    }
}
