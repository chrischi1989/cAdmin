<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Module\Tasks\FindModuleTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class EditAction
 * @package Modules\Accesslayer\Actions
 */
class EditAction
{
    /**
     * @var FindLayerTask
     */
    private $findLayerTask;
    /**
     * @var FindModuleTask
     */
    private $findModuleTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * EditAction constructor.
     * @param FindLayerTask $findLayerTask
     * @param FindModuleTask $findModuleTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindLayerTask $findLayerTask,
        FindModuleTask $findModuleTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findLayerTask       = $findLayerTask;
        $this->findModuleTask      = $findModuleTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'accesslayer');
    }

    /**
     * @param $layerUuid
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run($layerUuid)
    {
        $this->authorizeActionTask->run('edit', Layer::class);

        return [
            'layer' => $this->findLayerTask->byUuid($layerUuid, ['permissions.module']),
            'modules' => $this->findModuleTask->run(['permissions'])
        ];
    }
}