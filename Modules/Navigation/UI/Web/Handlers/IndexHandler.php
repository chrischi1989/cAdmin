<?php

namespace Modules\Navigation\UI\Web\Handlers;

use Modules\Navigation\Actions\IndexAction;

class IndexHandler
{
    private $indexAction;

    public function __construct(IndexAction $indexAction)
    {
        $this->indexAction = $indexAction;
    }

    public function __invoke()
    {
        $items = $this->indexAction->run();

        return view('navigation::index', ['items' => $items]);
    }
}
