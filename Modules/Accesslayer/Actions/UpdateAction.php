<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Accesslayer\Tasks\UpdateLayerPermissionsTask;
use Modules\Accesslayer\Tasks\UpdateLayerTask;
use Modules\Accesslayer\UI\Web\Requests\UpdateRequest;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class UpdateAction
 * @package Modules\Accesslayer\Actions
 */
class UpdateAction
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
     * @var UpdateLayerTask
     */
    private $updateLayerTask;
    /**
     * @var UpdateLayerPermissionsTask
     */
    private $updateLayerPermissionsTask;

    /**
     * UpdateAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param FindLayerTask $findLayerTask
     * @param UpdateLayerTask $updateLayerTask
     * @param UpdateLayerPermissionsTask $updateLayerPermissionsTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindLayerTask $findLayerTask,
        UpdateLayerTask $updateLayerTask,
        UpdateLayerPermissionsTask $updateLayerPermissionsTask
    ) {
        $this->authorizeActionTask        = $authorizeActionTask;
        $this->findLayerTask              = $findLayerTask;
        $this->updateLayerTask            = $updateLayerTask;
        $this->updateLayerPermissionsTask = $updateLayerPermissionsTask;
    }

    /**
     * @param UpdateRequest $request
     * @return bool
     * @throws \Exception
     */
    public function run(UpdateRequest $request)
    {
        $this->authorizeActionTask->run('edit', Layer::class);

        $layer     = $this->findLayerTask->byUuid($request->post('uuid'));
        $layerData = $this->prepareLayerData($request);

        return $this->updateLayerTask->run($layer, $layerData) &&
               $this->updateLayerPermissionsTask->run($layer, $request);
    }

    /**
     * @param UpdateRequest $request
     * @return array
     */
    private function prepareLayerData(UpdateRequest $request)
    {
        return [
            'updated_uuid' => $request->user()->uuid,
            'layer'        => $request->post('layer'),
            'priority'     => $request->post('priority')
        ];
    }
}