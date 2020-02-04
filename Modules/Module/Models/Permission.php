<?php

namespace Modules\Module\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $incrementing  = false;
    protected $table      = 'modules_permissions';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    public function module() {
        return $this->belongsTo(Module::class, 'module_uuid', 'uuid');
    }
}
