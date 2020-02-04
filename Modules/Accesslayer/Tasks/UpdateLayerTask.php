<?php

namespace Modules\Accesslayer\Tasks;

use Modules\Accesslayer\Models\Layer;

/**
 * Class UpdateLayerTask
 * @package Modules\Accesslayer\Tasks
 */
class UpdateLayerTask
{
    /**
     * @param Layer $layer
     * @param array $data
     * @return bool
     */
    public function run(Layer $layer, $data = [])
    {
        $layer->updated_uuid = $data['updated_uuid'] ?? $layer->updated_uuid;
        $layer->layer        = $data['layer'];
        $layer->priority     = $data['priority'];

        return $layer->save();
    }
}
