<?php

namespace Modules\Module\Tasks;

/**
 * Class ScanForModulesTask
 * @package Modules\Module\Tasks
 */
class ScanForModulesTask
{
    /**
     * @param null $modulePath
     * @return \Illuminate\Support\Collection
     */
    public function run($modulePath = null)
    {
        $blacklistModules = [
            '.',
            '..',
            'Install'
        ];

        $modules = collect();

        foreach(scandir(base_path((is_null($modulePath) ? 'Modules' : $modulePath))) as $key => $module) {
            if(!in_array($module, $blacklistModules)) {
                $subModulePath = (is_null($modulePath) ? 'Modules/' . $module . '/Modules' : $modulePath . '/' . $module . '/Modules');

                $modules->push([
                    'name'    => $module,
                    'modules' => is_dir(base_path($subModulePath)) ? $this->run($subModulePath) : null
                ]);
            }
        }

        return $modules;
    }
}