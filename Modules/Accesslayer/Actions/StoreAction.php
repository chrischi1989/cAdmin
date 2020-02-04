<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\Tasks\FindLayerTask;
use Modules\Accesslayer\Tasks\StoreLayerPermissionsTask;
use Modules\Accesslayer\Tasks\StoreLayerTask;
use Modules\Accesslayer\UI\Web\Requests\StoreRequest;
use Modules\User\Tasks\AuthorizeActionTask;
use Ramsey\Uuid\Uuid;

/**
 * Class StoreAction
 * @package Modules\Accesslayer\Actions
 */
class StoreAction
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
     * @var StoreLayerTask
     */
    private $storeLayerTask;
    /**
     * @var StoreLayerPermissionsTask
     */
    private $storeLayerPermissionsTask;

    /**
     * StoreAction constructor.
     * @param AuthorizeActionTask $authorizeActionTask
     * @param FindLayerTask $findLayerTask
     * @param StoreLayerTask $storeLayerTask
     * @param StoreLayerPermissionsTask $storeLayerPermissionsTask
     */
    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindLayerTask $findLayerTask,
        StoreLayerTask $storeLayerTask,
        StoreLayerPermissionsTask $storeLayerPermissionsTask
    ) {
        $this->authorizeActionTask       = $authorizeActionTask;
        $this->findLayerTask             = $findLayerTask;
        $this->storeLayerTask            = $storeLayerTask;
        $this->storeLayerPermissionsTask = $storeLayerPermissionsTask;
    }

    /**
     * @param StoreRequest $request
     * @return bool
     * @throws \Exception
     */
    public function run(StoreRequest $request)
    {
        $this->authorizeActionTask->run('create', Layer::class);

        $layerUuid = Uuid::uuid4();

        if($this->storeLayerTask->run($this->prepareLayerData($request, $layerUuid))) {
            $layer = $this->findLayerTask->byUuid($layerUuid);

            return $this->storeLayerPermissionsTask->run($layer, $request);
        }

        return false;
    }

    /**
     * @param StoreRequest $request
     * @param $layerUuid
     * @return array
     */
    private function prepareLayerData(StoreRequest $request, $layerUuid)
    {
        return [
            'uuid'         => $layerUuid,
            'created_uuid' => $request->user()->uuid,
            'updated_uuid' => $request->user()->uuid,
            'layer'        => $request->post('layer'),
            'priority'     => $request->post('priority')
        ];
    }
}