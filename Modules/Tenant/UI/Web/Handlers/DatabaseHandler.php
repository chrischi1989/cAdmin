<?php

namespace Modules\Tenant\UI\Web\Handlers;

use App\Controller;
use Modules\Tenant\Actions\DatabaseAction;
use Modules\Tenant\UI\Web\Requests\DatabaseRequest;

/**
 * Class DatabaseHandler
 * @package Modules\Tenant\UI\Web\Handlers
 */
class DatabaseHandler extends Controller
{
    /**
     * @var DatabaseAction
     */
    private $databaseAction;

    /**
     * DatabaseHandler constructor.
     * @param DatabaseAction $databaseAction
     */
    public function __construct(DatabaseAction $databaseAction)
    {
        $this->databaseAction = $databaseAction;
    }

    /**
     * @param DatabaseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(DatabaseRequest $request)
    {
        return $this->databaseAction->run($request) ? $request->success() : $request->failed();
    }
}