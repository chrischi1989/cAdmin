<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use App\Controller;
use Modules\Accesslayer\Actions\IndexAction;

/**
 * Class IndexHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke()
    {
        $layers = $this->indexAction->run();

        return view('Accesslayer::index', [
            'accesslayers' => $layers
        ]);
    }
}
