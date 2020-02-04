<?php

namespace Modules\Setting\Actions;

use App\Controller;
use Modules\Setting\Models\Setting;
use Modules\Setting\Tasks\FindSettingTask;
use Modules\User\Tasks\AuthorizeActionTask;

class IndexAction extends Controller
{
    private $authorizeActionTask;
    private $findSettingTask;

    public function __construct(AuthorizeActionTask $authorizeActionTask, FindSettingTask $findSettingTask)
    {
        view()->share('active', 'settings');

        $this->authorizeActionTask = $authorizeActionTask;
        $this->findSettingTask     = $findSettingTask;
    }

    public function run()
    {
        $this->authorizeActionTask->run('show', Setting::class);

        return $this->findSettingTask->run();
    }
}