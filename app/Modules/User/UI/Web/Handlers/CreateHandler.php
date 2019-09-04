<?php

namespace psnXT\Modules\User\UI\Web\Handlers;

use psnXT\Modules\User\Actions\CreateAction;

class CreateHandler
{
    private $createAction;

    public function __construct(CreateAction $createAction)
    {
        $this->createAction = $createAction;
    }

    public function __invoke()
    {
        $return = $this->createAction->run();

        return view('user::create-edit', [
            'tenants'     => $return['tenants'],
            'accesslayer' => $return['accesslayer']
        ]);
    }
}
