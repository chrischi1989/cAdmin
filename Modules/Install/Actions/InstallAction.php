<?php

namespace Modules\Install\Actions;

use App\Helpers;
use Modules\Install\Tasks\InstallTask;
use Modules\Install\Tasks\SeedTablesTask;
use Modules\Install\Tasks\SendInstallationMailTask;
use Modules\Install\UI\Web\Requests\Install;
use Modules\Setting\Tasks\UpdateEnvTask;
use Ramsey\Uuid\Uuid;

/**
 * Class InstallAction
 * @package Modules\Install\Actions
 */
class InstallAction
{
    /**
     * @var UpdateEnvTask
     */
    private $updateEnvTask;
    /**
     * @var SeedTablesTask
     */
    private $seedTablesTask;
    /**
     * @var InstallTask
     */
    private $installTask;
    /**
     * @var SendInstallationMailTask
     */
    private $sendInstallationMailTask;

    /**
     * InstallAction constructor.
     * @param UpdateEnvTask $updateEnvTask
     * @param SeedTablesTask $seedTablesTask
     * @param InstallTask $installTask
     * @param SendInstallationMailTask $sendInstallationMailTask
     */
    public function __construct(
        UpdateEnvTask $updateEnvTask,
        SeedTablesTask $seedTablesTask,
        InstallTask $installTask,
        SendInstallationMailTask $sendInstallationMailTask
    ) {
        $this->updateEnvTask            = $updateEnvTask;
        $this->seedTablesTask           = $seedTablesTask;
        $this->installTask              = $installTask;
        $this->sendInstallationMailTask = $sendInstallationMailTask;
    }

    /**
     * @param Install $request
     * @return bool
     * @throws \Exception
     */
    public function run(Install $request)
    {
        session([
            'uuid'     => Uuid::uuid4(),
            'password' => 'abc.123'
        ]);

        $envData = [
            'APP_NAME'      => $request->post('APP_NAME'),
            'APP_DEBUG'     => $request->post('APP_DEBUG'),
            'APP_URL'       => $request->post('APP_URL'),
            'APP_SUPPORT'   => $request->post('APP_SUPPORT'),
            'DB_CONNECTION' => $request->post('DB_CONNECTION'),
            'DB_HOST'       => $request->post('DB_HOST'),
            'DB_PORT'       => $request->post('DB_PORT'),
            'DB_DATABASE'   => $request->post('DB_DATABASE'),
            'DB_USERNAME'   => $request->post('DB_USERNAME'),
            'DB_PASSWORD'   => $request->post('DB_PASSWORD'),
        ];

        if($this->updateEnvTask->run($envData)) {
            return $this->installTask->run() &&
                   $this->seedTablesTask->run();
                   //$this->sendInstallationMailTask->run($request->post('email')) &&
        }

        return false;
    }
}
