<?php

namespace Modules\Tenant\UI\Web\Handlers;

use Modules\Tenant\Actions\CreateAction;

class CreateHandler
{
    private $createAction;

    public function __construct(CreateAction $createAction)
    {
        $this->createAction = $createAction;
    }

    public function __invoke()
    {
        $this->createAction->run();

        return view('Tenant::create-edit');
    }
}
