<?php

namespace Modules\Module\Models;

use App\Traits\Uuids;
use App\Traits\Who;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;
use App\Traits\Tenant;

/**
 * Class Module
 *
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property string $module
 * @property string $public_name
 * @property int $position
 * @property boolean $core
 *
 * @package Modules\Module\Models
 */
class Module extends Model
{
    use Uuids;
    use Who;
    use Tenant;

    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'modules';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(ModulePermission::class, 'module_uuid', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules() {
        return $this->hasMany(Module::class, 'parent_uuid', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childModules()
    {
        return $this->modules()->with('childModules');
    }
}
