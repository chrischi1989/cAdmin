<?php
namespace Modules\Module\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Accesslayer\Models\Layer;
use App\Traits\Tenant;

/**
 * Class ModulePermission
 *
 * @property int $id
 * @property string $uuid
 * @property string $module_uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $permission
 * @property Layer $accesslayer
 *
 * @package Modules\Modules\Entities
 */
class ModulePermission extends Model
{
    use Tenant;

    public $incrementing  = false;
    protected $table      = 'modules_permissions';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'module_uuid',
        'created_at',
        'updated_at',
        'permission'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_uuid', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accesslayer()
    {
        return $this->belongsToMany(Layer::class, 'mdl_accesslayer_has_modules_permissions', 'modulepermission_uuid', 'layer_uuid');
    }
}
