<?php

namespace psnXT\Modules\Install\UI\Web\Handlers;

use psnXT\Modules\Install\Actions\InstallAction;
use psnXT\Modules\Install\UI\Web\Requests\Install;

/**
 * Class InstallHandler
 * @package psnXT\Modules\Install\UI\Web\Handlers
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
     * @return mixed
     */
    public function __invoke(Install $request)
    {
        return $this->installAction->run($request) ? $request->success() : $request->failed();
    }
}
