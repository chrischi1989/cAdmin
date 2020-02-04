<?php

namespace Modules\Tenant\UI\Web\Handlers;

use App\Controller;
use Modules\Tenant\Actions\IndexAction;

/**
 * Class IndexHandler
 * @package Modules\Tenant\UI\Web\Handlers
 */
class IndexHandler extends Controller
{
    /**
     * @var IndexAction
     */
    private $indexAction;

    /**
     * IndexHandler constructor.
     * @param IndexAction $indexAction
     */
    public function __construct(IndexAction $indexAction)
    {
        $this->indexAction = $indexAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $tenants = $this->indexAction->run();

        return view('Tenant::index', ['tenants' => $tenants]);
    }
}
