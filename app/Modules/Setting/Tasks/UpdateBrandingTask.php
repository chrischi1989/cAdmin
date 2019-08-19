<?php

namespace app\Modules\Setting\Tasks;

class UpdateBrandingTask
{
    /**
     * @param array $data
     * @return mixed
     */
    public function run($data = [])
    {
        return $data['APP_BRANDING']->storeAs('public', 'branding.jpg');
    }
}
