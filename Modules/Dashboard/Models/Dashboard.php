<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dashboard
 *
 * @package Modules\Dashboard\Models
 */
class Dashboard extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'dashboards';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function widgets()
    {
        return $this->belongsToMany(Widget::class, 'dashboards_has_widgets', 'dashboard_uuid', 'widget_uuid');
    }
}
