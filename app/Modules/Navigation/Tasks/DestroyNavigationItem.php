<?php

namespace psnXT\Modules\Navigation\Tasks;

use psnXT\Modules\Navigation\Models\Item;

/**
 * Class DestroyNavigationItem
 * @package psnXT\Modules\Navigation\Tasks
 */
class DestroyNavigationItem
{
    public function run(Item $item)
    {
        return $item->delete();
    }
}