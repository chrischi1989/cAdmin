<?php

namespace psnXT\Modules\Accesslayer\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use psnXT\Modules\Module\Models\Permission;
use psnXT\Modules\User\Models\User;

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
 * @package psnXT\Modules\Accesslayer\Models
 */
class Layer extends Model
{
    public $incrementing  = false;
    protected $table      = 'accesslayer';
    protected $primaryKey = 'uuid';

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'accesslayer_has_modules_permissions', 'layer_uuid', 'permission_uuid');
    }
}
