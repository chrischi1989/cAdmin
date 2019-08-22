<?php

namespace psnXT\Modules\Install\UI\Web\Handlers;

use psnXT\Modules\Install\Actions\SetupAction;

/**
 * Class SetupHandler
 * @package psnXT\Modules\Install\UI\Web\Handlers
 */
class SetupHandler
{
    private $setupAction;

    public function __construct(SetupAction $setupAction)
    {
        $this->setupAction = $setupAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return !$this->setupAction->run() ? view('Install.UI.Web.Views.setup') : redirect()->route('user-login-page');
    }
}
