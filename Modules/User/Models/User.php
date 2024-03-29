<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Dashboard\Models\Dashboard;
use Modules\Tenant\Models\Tenant as TenantRelation;
use Modules\Accesslayer\Models\Layer;
use App\Traits\Tenant;
use App\Traits\Uuids;
use App\Traits\Who;

/**
 * Class User
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
 * @property Carbon $activated_at
 * @property string $activated_uuid
 * @property User $activated_by
 * @property Carbon $deactivated_at
 * @property string $deactivated_uuid
 * @property User $deactivated_by
 * @property Carbon $lastlogin_at
 * @property string $email_hashed
 * @property string $email_encrypted
 * @property string $password
 * @property string $remember_token
 * @property string $activation_token
 * @property int $failed_logins
 * @property int $failed_logins_max
 * @property boolean $password_expires
 * @property int $password_expires_days
 * @property Collection $accesslayer
 * @property Profile $profile
 * @property PasswordReset $passwordReset
 * @property Collection $permissions
 *
 * @package Modules\User\Models
 */
class User extends Authenticatable
{
    use Tenant;
    use Who;
    use Uuids;
    use Notifiable;

    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return HasOne
     */
    public function tenant(): HasOne
    {
        return $this->hasOne(TenantRelation::class, 'uuid', 'tenant_uuid');
    }

    /**
     * @return BelongsToMany
     */
    public function accesslayer(): BelongsToMany
    {
        return $this->belongsToMany(Layer::class, 'users_has_accesslayer', 'user_uuid', 'layer_uuid');
    }

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_uuid', 'uuid');
    }

    /**
     * @return HasOne
     */
    public function passwordReset(): HasOne
    {
        return $this->hasOne(PasswordReset::class, 'user_uuid', 'uuid');
    }

    /**
     * @return HasMany
     */
    public function dashboards(): HasMany
    {
        return $this->hasMany(Dashboard::class, 'user_uuid', 'uuid');
    }

    /**
     * @param $value
     */
    public function setEmailHashedAttribute($value)
    {
        $this->attributes['email_hashed'] = hash('sha512', $value);
    }

    /**
     * @param $value
     */
    public function setEmailEncryptedAttribute($value)
    {
        $this->attributes['email_encrypted'] = encrypt($value);
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getEmailEncryptedAttribute($value)
    {
        return decrypt($value);
    }
}
