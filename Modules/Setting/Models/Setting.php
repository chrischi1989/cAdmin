<?php

namespace Modules\Setting\Models;

use App\Traits\Uuids;
use App\Traits\Who;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Module\Models\Module;
use Modules\User\Models\User;
use App\Traits\Tenant;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property string $description
 * @property string $setting
 * @property string $setting_value
 * @property string $setting_values
 * @property string $setting_type
 *
 * @package Modules\Setting\Models
 */
class Setting extends Model
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
    protected $table = 'settings';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_uuid', 'uuid');
    }
}
