<?php

namespace Modules\Navigation\Tasks;

use Modules\Navigation\Models\Item;

/**
 * Class DestroyNavigationItem
 * @package Modules\Navigation\Tasks
 */
class DestroyNavigationItem
{
    public function run(Item $item)
    {
        return $item->delete();
    }
}