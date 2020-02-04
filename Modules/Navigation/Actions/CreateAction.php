<?php

namespace Modules\Navigation\Actions;

use Modules\Navigation\Models\Item;
use Modules\Navigation\Tasks\GetAvailableRoutesTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class CreateAction
 * @package Modules\Navigation\Actions
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
