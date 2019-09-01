<?php

namespace psnXT\Modules\Navigation\Actions;

use psnXT\Modules\Navigation\Models\Item;
use psnXT\Modules\Navigation\Tasks\GetAvailableRoutesTask;
use psnXT\Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class CreateAction
 * @package psnXT\Modules\Navigation\Actions
 */
class CreateAction
{
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;
    /**
     * @var GetAvailableRoutesTask
     */
    private $getAvaialbleRoutesTask;

    /**
     * CreateAction constructor.
     * @param GetAvailableRoutesTask $getAvaialbleRoutesTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        GetAvailableRoutesTask $getAvaialbleRoutesTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->authorizeActionTask = $authorizeActionTask;
        $this->getAvaialbleRoutesTask = $getAvaialbleRoutesTask;

        view()->share('active', 'navigation');
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('create', Item::class);

        return $this->getAvaialbleRoutesTask->run();
    }
}
