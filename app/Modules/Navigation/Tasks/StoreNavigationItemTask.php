<?php

namespace psnXT\Modules\Navigation\Tasks;

use psnXT\Modules\Navigation\Models\Item;

/**
 * Class StoreNavigationItemTask
 * @package psnXT\Modules\Navigation\Tasks
 */
class StoreNavigationItemTask
{
    /**
     * @var Item
     */
    private $item;

    /**
     * StoreNavigationItemTask constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        $this->item->created_uuid  = $data['created_uuid'] ?? null;
        $this->item->updated_uuid  = $data['updated_uuid'] ?? null;
        $this->item->disabled_at   = $data['disabled_at'] ?? null;
        $this->item->disabled_uuid = $data['disabled_uuid'] ?? null;
        $this->item->position      = 0;
        $this->item->icon          = $data['icon'] ?? null;
        $this->item->title         = $data['title'] ?? null;
        $this->item->href          = $data['href'] ?? null;
        $this->item->deleteable    = true;

        return $this->item->save();
    }
}