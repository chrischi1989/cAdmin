<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use App\Controller;
use Modules\Accesslayer\Actions\UpdateAction;
use Modules\Accesslayer\UI\Web\Requests\UpdateRequest;

/**
 * Class UpdateHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
 */
class UpdateHandler extends Controller
{
    /**
     * @var UpdateAction
     */
    private $updateAction;

    /**
     * UpdateHandler constructor.
     * @param UpdateAction $updateAction
     */
    public function __construct(UpdateAction $updateAction)
    {
        $this->updateAction = $updateAction;
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(UpdateRequest $request)
    {
        return $this->updateAction->run($request) ? $request->success() : $request->failed();
    }
}
