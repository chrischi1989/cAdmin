<?php

namespace Modules\Accesslayer\UI\Web\Handlers;

use App\Controller;
use Modules\Accesslayer\Actions\CreateAction;

/**
 * Class CreateHandler
 * @package Modules\Accesslayer\UI\Web\Handlers
 */
class CreateHandler extends Controller
{
    /**
     * @var CreateAction
     */
    private $createAction;

    /**
     * CreateHandler constructor.
     * @param CreateAction $createAction
     */
    public function __construct(CreateAction $createAction)
    {
        $this->createAction = $createAction;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke()
    {
        $return = $this->createAction->run();

        return view('Accesslayer::create-edit', [
            'modules' => $return['modules']
        ]);
    }
}
