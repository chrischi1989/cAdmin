<?php

namespace psnXT\Modules\Tenant\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    public $incrementing  = false;
    protected $table      = 'tenants';
    protected $primaryKey = 'uuid';
}
