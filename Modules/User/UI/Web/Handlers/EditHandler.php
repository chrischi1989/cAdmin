<?php

namespace Modules\User\UI\Web\Handlers;

use Modules\User\Actions\EditAction;
use Modules\User\UI\Web\Requests\EditRequest;

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
