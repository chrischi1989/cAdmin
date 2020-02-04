<?php

namespace Modules\Module\Actions;

use Modules\Module\Models\Module;
use Modules\Module\Tasks\FindModuleTask;
use Modules\Module\Tasks\ScanForModulesTask;
use Modules\User\Tasks\AuthorizeActionTask;

class IndexAction
{
    private $authorizeActionTask;
    private $findModuleTask;
    private $scanForModulesTask;

    public function __construct(
        AuthorizeActionTask $authorizeActionTask,
        FindModuleTask $findModuleTask,
        ScanForModulesTask $scanForModulesTask
    ) {
        $this->authorizeActionTask = $authorizeActionTask;
        $this->findModuleTask      = $findModuleTask;
        $this->scanForModulesTask  = $scanForModulesTask;

        view()->share('active', 'module');
    }

    public function run()
    {
        $this->authorizeActionTask->run('show', Module::class);

        $installedModules = $this->findModuleTask->run(['childModules', 'createdBy', 'updatedBy']);
        $availableModules = $this->scanForModulesTask->run();
        $availableModules = $this->findNestedAvailableModules($availableModules, $installedModules);

        return [
            'installedModules' => $installedModules,
            'availableModules' => $availableModules
        ];
    }

    private function findNestedAvailableModules($availableModules, $installedModules)
    {
        return $availableModules->filter(function($module) use ($installedModules) {
            if(is_null($installedModules)) return true;

            if (!is_null($module['modules'])) {
                return $this->findNestedAvailableModules($module['modules'], $installedModules->where('module', $module['name'])->first()->childModules);
            }

            return !$installedModules->where('module', $module['name'])->count() > 0;
        });
    }
}