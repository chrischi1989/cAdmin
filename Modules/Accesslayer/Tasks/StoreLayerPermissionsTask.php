<?php

namespace Modules\Accesslayer\Tasks;

use Carbon\Carbon;
use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\UI\Web\Requests\StoreRequest;
use Ramsey\Uuid\Uuid;

/**
 * Class StoreLayerPermissionsTask
 * @package Modules\Accesslayer\Tasks
 */
class StoreLayerPermissionsTask
{
    /**
     * @param Layer $layer
     * @param StoreRequest $request
     * @return bool
     * @throws \Exception
     */
    public function run(Layer $layer, StoreRequest $request)
    {
        foreach($request->post('permissions') as $module => $permissions) {
            $layer->permissions()->attach($permissions, [
                'uuid'         => Uuid::uuid4(),
                'created_at'   => Carbon::now(),
                'created_uuid' => $request->user()->uuid,
                'updated_at'   => Carbon::now(),
                'updated_uuid' => $request->user()->uuid
            ]);
        }

        return true;
    }
}