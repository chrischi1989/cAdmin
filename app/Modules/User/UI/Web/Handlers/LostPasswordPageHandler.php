<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use app\Modules\User\Actions\SetResetDelayAction;
use Illuminate\Http\Request;

class LostPasswordPageHandler
{
    private $setResetDelayAction;

    public function __construct(SetResetDelayAction $setResetDelayAction)
    {
        $this->setResetDelayAction = $setResetDelayAction;
    }

    public function __invoke(Request $request)
    {
        $resetDelay = $this->setResetDelayAction->run();

        return view('User.UI.Web.Views.lost-password', [
            'resetDelay' => $resetDelay
        ]);
    }
}
