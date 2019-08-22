<?php

namespace psnXT\Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use psnXT\Modules\Accesslayer\Models\Layer;
use psnXT\Traits\Tenant;

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
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $activation_token
 * @property int $failed_logins
 * @property int $failed_logins_max
 * @property boolean $password_expires
 * @property int $password_expires_days
 *
 * @package psnXT\Modules\User\Models
 */
class User extends Authenticatable
{
    use Tenant;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accesslayer()
    {
        return $this->belongsToMany(Layer::class, 'users_has_accesslayer', 'layer_uuid', 'user_uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_uuid', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function passwordReset()
    {
        return $this->hasOne(PasswordReset::class, 'user_uuid', 'uuid');
    }
}
