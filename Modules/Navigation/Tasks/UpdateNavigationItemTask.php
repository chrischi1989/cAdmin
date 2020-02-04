<?php

namespace Modules\Navigation\Tasks;

use Modules\Navigation\Models\Item;

/**
 * Class UpdateNavigationItemTask
 * @package Modules\Navigation\Tasks
 */
class UpdateNavigationItemTask
{
    /**
     * @param Item $item
     * @param $data
     * @return bool
     */
    public function run(Item $item, $data)
    {
        $item->parent_uuid   = array_key_exists('parent_uuid', $data) ? $data['parent_uuid'] : $item->parent_uuid;
        $item->updated_uuid  = $data['updated_uuid'] ?? $item->updated_uuid;
        $item->disabled_at   = $data['disabled_at'] ?? $item->disabled_at;
        $item->disabled_uuid = $data['disabled_uuid'] ?? $item->disabled_uuid;
        $item->position      = $data['position'] ?? $item->position;
        $item->icon          = $data['icon'] ?? $item->icon;
        $item->title         = $data['title'] ?? $item->title;
        $item->href          = $data['href'] ?? $item->href;

        print_r($item);

        return $item->save();
    }
}