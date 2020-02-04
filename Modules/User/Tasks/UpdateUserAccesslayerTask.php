<?php

namespace Modules\User\Tasks;

use Modules\User\Models\User;
use Ramsey\Uuid\Uuid;

/**
 * Class UpdateUserAccesslayerTask
 * @package Modules\User\Tasks
 */
class UpdateUserAccesslayerTask
{
    /**
     * @param User $user
     * @param string $accesslayer
     * @param array $metaData
     * @return bool
     * @throws \Exception
     */
    public function run(User $user, $accesslayer = '', $metaData = [])
    {
        $user->accesslayer()->detach();
        $user->accesslayer()->attach($accesslayer, [
            'uuid'         => Uuid::uuid4(),
            'created_at'   => now(),
            'created_uuid' => $metaData['created_uuid'],
            'updated_at'   => now(),
            'updated_uuid' => $metaData['updated_uuid']
        ]);

        return true;
    }
}
