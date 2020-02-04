<?php

namespace Modules\Tenant\UI\Web\Handlers;

use App\Controller;
use Modules\Tenant\Actions\EditAction;
use Modules\Tenant\UI\Web\Requests\EditRequest;

/**
 * Class EditHandler
 * @package Modules\Tenant\UI\Web\Handlers
 */
class EditHandler extends Controller
{
    /**
     * @var EditAction
     */
    private $editAction;

    /**
     * EditHandler constructor.
     * @param EditAction $editAction
     */
    public function __construct(EditAction $editAction)
    {
        $this->editAction = $editAction;
    }

    /**
     * @param EditRequest $request
     * @param $tenantUuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(EditRequest $request, $tenantUuid)
    {
        $return = $this->editAction->run($tenantUuid);

        return view('Tenant::create-edit', [
            'tenant'         => $return['tenant'],
            'tenantDatabase' => $return['tenantDatabase']
        ]);
    }
}
