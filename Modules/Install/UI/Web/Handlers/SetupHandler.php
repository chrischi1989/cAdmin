<?php

namespace Modules\Install\UI\Web\Handlers;

use Modules\Install\Actions\SetupAction;

/**
 * Class SetupHandler
 * @package Modules\Install\UI\Web\Handlers
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
        return !$this->setupAction->run() ? view('Install::setup') : redirect()->route('user-login-page');
    }
}
