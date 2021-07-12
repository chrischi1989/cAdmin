<?php

namespace Modules\User\UI\Web\Handlers;

use App\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Modules\User\Actions\IndexAction;

/**
 * Class IndexHandler
 * @package Modules\User\UI\Web\Handlers
 */
class IndexHandler extends Controller
{
    /**
     * @var IndexAction
     */
    private $indexAction;

    private $view;

    /**
     * IndexHandler constructor.
     * @param IndexAction $indexAction
     * @param Factory $view
     */
    public function __construct(IndexAction $indexAction, Factory $view)
    {
        $this->indexAction = $indexAction;
        $this->view        = $view;
    }

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function __invoke(): View
    {
        $users = $this->indexAction->run();

        return $this->view->make('user::index', ['users' => $users]);
    }
}
