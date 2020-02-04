<?php

namespace Modules\Module\Tasks;

use Modules\Module\Models\Module;

/**
 * Class FindLayerTask
 * @package Modules\Accesslayer\Tasks
 */
class FindModuleTask
{
    /**
     * @var Module
     */
    private $module;
    /**
     * @var
     */
    private $query;

    /**
     * FindModuleTask constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Module[]
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->module->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->module->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }
}
