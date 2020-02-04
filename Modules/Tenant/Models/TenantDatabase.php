<?php

namespace Modules\Tenant\Models;

use App\Traits\Uuids;
use App\Traits\Who;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

/**
 * Class TenantDatabase
 *
 * @property int $id
 * @property string $uuid
 * @property string $tenant_uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property string $connection
 * @property string $hostname
 * @property string $username
 * @property string $password
 * @property string $database
 * @property string $port
 * @property boolean $schema_created
 *
 * @package Modules\Tenant\Models
 */
class TenantDatabase extends Model
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
    protected $table = 'tenants_databases';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';
    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @param $value
     */
    public function setConnectionAttribute($value)
    {
        $this->attributes['connection'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setHostnameAttribute($value)
    {
        $this->attributes['hostname'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setDatabaseAttribute($value)
    {
        $this->attributes['database'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setPortAttribute($value)
    {
        $this->attributes['port'] = encrypt($value);
    }

    public function getConnectionAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getHostnameAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getUsernameAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPasswordAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getDatabaseAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPortAttribute($value)
    {
        return decrypt($value);
    }
}