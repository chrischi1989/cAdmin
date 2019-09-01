<?php

namespace psnXT\Modules\Navigation\Tasks;

use psnXT\Modules\Navigation\Models\Item;

/**
 * Class FindNavigationItemTask
 * @package psnXT\Modules\Navigation\Tasks
 */
class FindNavigationItemTask
{
    /**
     * @var Item
     */
    private $item;
    /**
     * @var
     */
    private $query;

    /**
     * FindNavigationItemTask constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Item[]
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->item->with($with)->get() : $this->query->get();
    }

    /**
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function byUuid($uuid, $with = [])
    {
        $this->query = $this->item->with($with)->where('uuid', $uuid);

        return $this->run()->first();
    }
}
