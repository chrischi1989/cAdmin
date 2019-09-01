<?php

namespace psnXT\Modules\Navigation\UI\Web\Handlers;

use Illuminate\Http\Request;
use psnXT\Modules\Navigation\Actions\SortAction;

/**
 * Class SortHandler
 * @package psnXT\Modules\Navigation\UI\Web\Handlers
 */
class SortHandler
{
    /**
     * @var SortAction
     */
    private $sortAction;

    /**
     * SortHandler constructor.
     * @param SortAction $sortAction
     */
    public function __construct(SortAction $sortAction)
    {
        $this->sortAction = $sortAction;
    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request)
    {
        return response()->json($this->sortAction->run($request));
    }
}
