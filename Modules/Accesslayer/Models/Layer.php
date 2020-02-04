<?php

namespace Modules\Accesslayer\Models;

use App\Traits\Tenant;
use App\Traits\Uuids;
use App\Traits\Who;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Module\Models\ModulePermission;
use Modules\User\Models\User;

/**
 * Class Layer
 *
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property string $layer
 * @property int $priority
 *
 * @package Modules\Accesslayer\Models
 */
class Layer extends Model
{
    use Uuids;
    use Who;
    use Tenant;

    public $incrementing  = false;
    protected $table      = 'accesslayer';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(ModulePermission::class, 'accesslayer_has_modules_permissions', 'layer_uuid', 'permission_uuid');
    }
}
