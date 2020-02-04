<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\Tasks\DestroyLayerTask;
use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Accesslayer\UI\Web\Requests\DestroyRequest;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class DestroyAction
 * @package Modules\Accesslayer\Actions
 */
class DestroyAction
{
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;
    /**
     * @var FindLayerTask
     */
    private $findLayerTask;
    /**
     * @var DestroyLayerTask
     */
    private $destroyLayerTask;

    /**
     * DestroyAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param FindLayerTask $findLayerTask
     * @param DestroyLayerTask $destroyLayerTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindLayerTask $findLayerTask,
        DestroyLayerTask $destroyLayerTask
    ) {
        $this->authorizeActionTask = $authorizeActionTask;
        $this->findLayerTask       = $findLayerTask;
        $this->destroyLayerTask    = $destroyLayerTask;
    }

    /**
     * @param DestroyRequest $request
     * @return bool|null
     * @throws \Illuminate\Auth\Access\AuthorizationException|\Exception
     */
    public function run(DestroyRequest $request)
    {
        $this->authorizeActionTask->run('destroy', Layer::class);

        $layer = $this->findLayerTask->byUuid($request->post('uuid'));

        return $this->destroyLayerTask->run($layer);
    }
}