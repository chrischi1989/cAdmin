<?php

namespace Modules\Navigation\UI\Web\Handlers;

use App\Controller;
use Modules\Navigation\Actions\CreateAction;

/**
 * Class CreateHandler
 * @package Modules\Navigation\UI\Web\Handlers
 */
class CreateHandler extends Controller
{
    /**
     * @var CreateAction
     */
    private $createAction;

    /**
     * CreateHandler constructor.
     * @param CreateAction $createAction
     */
    public function __construct(CreateAction $createAction)
    {
        $this->createAction = $createAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke()
    {
        $routes = $this->createAction->run();

        return view('navigation::create-edit', ['routes' => $routes]);
    }
}
