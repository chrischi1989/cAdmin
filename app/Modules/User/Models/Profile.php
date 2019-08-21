<?php

namespace psnXT\Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
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
 * @property string $salutation
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $street
 * @property string $housenumber
 * @property string $postalcode
 * @property string $location
 * @property string $telephone
 * @property string $cellphone
 *
 * @package psnXT\Modules\User\Models
 */
class Profile extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'users_profiles';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';
}
