<?php

namespace Modules\User\UI\Web\Handlers;

use App\Controller;
use Modules\User\Actions\IndexAction;
use Modules\User\Models\User;

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
        $users = $this->indexAction->run();

        return view('user::index', ['users' => $users]);
    }
}
