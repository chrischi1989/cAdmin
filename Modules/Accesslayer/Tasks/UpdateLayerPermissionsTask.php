<?php

namespace Modules\Accesslayer\Tasks;

use Modules\Accesslayer\Models\Layer;
use Modules\Accesslayer\UI\Web\Requests\UpdateRequest;
use Ramsey\Uuid\Uuid;

/**
 * Class UpdateLayerPermissionsTask
 * @package Modules\Accesslayer\Tasks
 */
class UpdateLayerPermissionsTask
{
    /**
     * @param Layer $layer
     * @param UpdateRequest $request
     * @return bool
     * @throws \Exception
     */
    public function run(Layer $layer, UpdateRequest $request)
    {
        $layer->permissions()->detach();

        if(!empty($request->post('permissions'))) {
            foreach($request->post('permissions') as $module => $permissions) {
                $layer->permissions()->attach($permissions, [
                    'uuid'         => Uuid::uuid4(),
                    'created_at'   => now(),
                    'created_uuid' => $request->user()->uuid,
                    'updated_at'   => now(),
                    'updated_uuid' => $request->user()->uuid
                ]);
            }

            return true;
        }
    }
}