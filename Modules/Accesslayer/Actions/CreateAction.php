<?php

namespace Modules\Accesslayer\Actions;

use Modules\Accesslayer\Models\Layer;
use Modules\Module\Tasks\FindModuleTask;
use Modules\User\Tasks\AuthorizeActionTask;

/**
 * Class CreateAction
 * @package Modules\Accesslayer\Actions
 */
class CreateAction
{
    /**
     * @var FindModuleTask
     */
    private $findModuleTask;
    /**
     * @var AuthorizeActionTask
     */
    private $authorizeActionTask;

    /**
     * CreateAction constructor.
     * @param FindModuleTask $findModuleTask
     * @param AuthorizeActionTask $authorizeActionTask
     */
    public function __construct(
        FindModuleTask $findModuleTask,
        AuthorizeActionTask $authorizeActionTask
    ) {
        $this->findModuleTask      = $findModuleTask;
        $this->authorizeActionTask = $authorizeActionTask;

        view()->share('active', 'accesslayer');
    }

    /**
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function run()
    {
        $this->authorizeActionTask->run('create', Layer::class);

        return [
            'modules' => $this->findModuleTask->run(['permissions'])
        ];
    }
}