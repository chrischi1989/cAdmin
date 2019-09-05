<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\EditAction;
use psnXT\Modules\User\UI\Web\Requests\EditRequest;

class EditHandler
{
    private $editAction;

    public function __construct(EditAction $editAction)
    {
        $this->editAction = $editAction;
    }

    public function __invoke(EditRequest $request, $userUuid)
    {
        $return = $this->editAction->run($userUuid);

        return view('user::create-edit', [
            'user'        => $return['user'],
            'tenants'     => $return['tenants'],
            'accesslayer' => $return['accesslayer']
        ]);
    }
}
