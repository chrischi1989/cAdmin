<?php

namespace Modules\Install\UI\Web\Handlers;

use Modules\Install\Actions\InstallAction;
use Modules\Install\UI\Web\Requests\Install;

/**
 * Class InstallHandler
 * @package Modules\Install\UI\Web\Handlers
 */
class InstallHandler
{
    /**
     * @var InstallAction
     */
    private $installAction;

    /**
     * InstallHandler constructor.
     * @param InstallAction $installAction
     */
    public function __construct(InstallAction $installAction)
    {
        $this->installAction = $installAction;
    }

    /**
     * @param Install $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(Install $request)
    {
        return $this->installAction->run($request) ? $request->success() : $request->failed();
    }
}
