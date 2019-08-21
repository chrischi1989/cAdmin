<?php

namespace psnXT\Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 *
 * @property int $id
 * @property string $uuid
 * @property string $user_uuid
 * @property Carbon $created_at
 * @property string $created_uuid
 * @property User $created_by
 * @property Carbon $updated_at
 * @property string $updated_uuid
 * @property User $updated_by
 * @property string $token
 * @property Carbon $token_until
 * @property User $user
 *
 * @package psnXT\Modules\User\Models
 */
class PasswordReset extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'users_password_resets';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var array
     */
    protected $dates = [
        'token_until'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
