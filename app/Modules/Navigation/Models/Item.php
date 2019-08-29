<?php

namespace psnXT\Modules\Navigation\Models;

use Illuminate\Database\Eloquent\Model;
use psnXT\Modules\Module\Models\Module;
use psnXT\Traits\Tenant;

class Item extends Model
{
    use Tenant;

    public $incrementing  = false;
    protected $table      = 'navigation';
    protected $primaryKey = 'uuid';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function module()
    {
        return $this->hasOne(Module::class, 'uuid', 'module_uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'parent_uuid', 'uuid')->orderBy('position', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childItems()
    {
        return $this->items()->with('childItems');
    }

}
