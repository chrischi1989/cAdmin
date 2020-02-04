<?php

namespace Modules\Accesslayer\Tasks;

use Modules\Accesslayer\Models\Layer;
use Ramsey\Uuid\Uuid;

/**
 * Class StoreLayerTask
 * @package Modules\Accesslayer\Tasks
 */
class StoreLayerTask
{
    /**
     * @var Layer
     */
    private $layer;

    /**
     * StoreLayerTask constructor.
     * @param Layer $layer
     */
    public function __construct(Layer $layer)
    {
        $this->layer = $layer;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function run($data = [])
    {
        $this->layer->uuid         = $data['uuid'] ?? Uuid::uuid4();
        $this->layer->created_uuid = $data['created_uuid'] ?? $this->layer->created_uuid;
        $this->layer->updated_uuid = $data['updated_uuid'] ?? $this->layer->updated_uuid;
        $this->layer->layer        = $data['layer'];
        $this->layer->priority     = $data['priority'];

        return $this->layer->save();
    }
}
