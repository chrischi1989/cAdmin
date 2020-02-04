<?php

namespace Modules\Setting\Tasks;

use Modules\Setting\Models\Setting;

/**
 * Class FindSettingTask
 * @package Modules\Setting\Tasks
 */
class FindSettingTask
{
    /**
     * @var Setting
     */
    private $setting;
    /**
     * @var
     */
    private $query;

    /**
     * FindSettingTask constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function run($with = [])
    {
        return is_null($this->query) ? $this->setting->with($with)->get() : $this->query->get();
    }
}