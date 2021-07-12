<?php
namespace App\Traits;

use Modules\User\Models\User;

trait Who
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_uuid', 'uuid');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_uuid', 'uuid');
    }
}
