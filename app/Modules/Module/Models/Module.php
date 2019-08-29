<?php

namespace psnXT\Modules\Module\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use psnXT\Modules\User\Models\User;
use psnXT\Traits\Tenant;

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
 * @package psnXT\Modules\Module\Models
 */
class Module extends Model
{
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
}
