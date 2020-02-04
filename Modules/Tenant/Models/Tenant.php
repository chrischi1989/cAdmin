<?php

namespace Modules\Tenant\Models;

use App\Traits\Uuids;
use App\Traits\Who;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tenant
 *
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property int $user_quota
 * @property string $tenant
 * @property string $street
 * @property string $housenumber
 * @property string $postalcode
 * @property string $location
 * @property string $email
 * @property string $telephone
 * @property string $mobile
 * @property string $website
 *
 * @package Modules\Tenant\Models
 */
class Tenant extends Model
{
    use Uuids;
    use Who;

    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'tenants';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function database()
    {
        return $this->hasOne(TenantDatabase::class, 'tenant_uuid', 'uuid');
    }
}
