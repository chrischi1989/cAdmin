<?php

namespace Modules\Navigation\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Module\Models\Module;
use Modules\User\Models\User;
use App\Traits\Tenant;
use App\Traits\Uuids;
use App\Traits\Who;

/**
 * Class Item
 *
 * @property int $id
 * @property string $uuid
 * @property string $parent_uuid
 * @property string $module_uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property Carbon $disabled_at
 * @property string $disabled_uuid
 * @property User $disabled_by
 * @property int $position
 * @property string $icon
 * @property string $title
 * @property string $href
 * @property boolean $deleteable
 *
 * @package Modules\Navigation\Models
 */
class Item extends Model
{
    use Tenant;
    use Uuids;
    use Who;

    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'navigation';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function module()
    {
        return $this->hasOne(Module::class, 'uuid', 'module_uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'parent_uuid', 'uuid')->orderBy('position', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childItems()
    {
        return $this->items()->with('childItems');
    }
}