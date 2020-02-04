<?php

namespace Modules\Accesslayer\Tasks;

use Modules\Accesslayer\Models\Layer;

/**
 * Class FindLayerTask
 * @package Modules\Accesslayer\Tasks
 */
class FindLayerTask
{
    /**
     * @var Layer
     */
    private $layer;
    /**
     * @var
     */
    private $query;

    /**
     * FindLayerTask constructor.
     * @param Layer $layer
     */
    public function __construct(Layer $layer)
    {
        $this->layer = $layer;
    }

    /**
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Layer[]
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->layer->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->layer->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }
}
