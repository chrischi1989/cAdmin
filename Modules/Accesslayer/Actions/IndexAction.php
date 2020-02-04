<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\User\Tasks\AuthorizeActionTask;
use Modules\Accesslayer\Tasks\FindLayerTask;

/**
 * Class IndexAction
 * @package Modules\User\Actions
 */
class IndexAction
{
    /**
     * @var FindLayerTask
     */
    private $findLayerTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * IndexAction constructor.
     * @param FindLayerTask $findLayerTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(FindLayerTask $findLayerTask, AuthorizeActionTask $authorizeActionTask)
    {
        $this->findLayerTask        = $findLayerTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'accesslayer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Layer[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('show', Layer::class);

        return $this->findLayerTask->run(['createdBy', 'updatedBy']);
    }
}
