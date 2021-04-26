<?php

namespace Modules\Page\UI\Web\Handlers;

use Modules\Page\Actions\CreateAction;

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

        return view('page::create-edit', [

        ]);
    }
}
