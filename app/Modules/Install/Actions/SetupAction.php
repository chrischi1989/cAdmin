<?php

namespace psnXT\Modules\Install\Actions;

/**
 * Class SetupAction
 * @package psnXT\Modules\Install\Actions
 */
class SetupAction
{
    /**
     * @return bool
     */
    public function run()
    {
        return file_exists(base_path('install.lock'));
    }
}
