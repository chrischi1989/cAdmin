<?php

namespace psnXT\Modules\Install\UI\Web\Handlers;

/**
 * Class SetupHandler
 * @package psnXT\Modules\Install\UI\Web\Handlers
 */
class SetupHandler
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('Install.UI.Web.Views.setup');
    }
}
