<?php

namespace Modules\Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Widget
 * @package Modules\Dashboard\Models
 */
class Widget extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = 'dashboards_widgets';
    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';
}
