<?php

namespace Modules\Accesslayer\Tasks;

use Modules\Accesslayer\Models\Layer;

/**
 * Class DestroyLayerTask
 * @package Modules\Accesslayer\Tasks
 */
class DestroyLayerTask
{
    /**
     * @param Layer $layer
     * @return bool|null
     * @throws \Exception
     */
    public function run(Layer $layer)
    {
        $layer->permissions()->detach();

        return $layer->delete();
    }
}