<?php

namespace psnXT\Modules\Install\Tasks;

class LockInstallerTask
{
    /**
     * @return bool
     */
    public function run()
    {
        file_put_contents(base_path() . '/install.lock', '');

        return file_exists(base_path() . '/install.lock');
    }
}
