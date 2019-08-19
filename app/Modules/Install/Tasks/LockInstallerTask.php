<?php

namespace psnXT\Modules\Install\Tasks;

class LockInstallerTask
{
    /**
     * @return bool|int
     */
    public function run()
    {
        return file_put_contents(base_path() . '/install.lock', '');
    }
}
