<?php

namespace psnXT\Modules\Tenant\UI\Web\Handlers;

use psnXT\Modules\Tenant\Actions\IndexAction;

class IndexHandler
{
    private $indexAction;

    public function __construct(IndexAction $indexAction)
    {
        $this->indexAction = $indexAction;
    }

    public function __invoke()
    {
        $tenants = $this->indexAction->run();

        return view('tenant::index', ['tenants' => $tenants]);
    }
}
