<?php

namespace psnXT\Modules\Install\Actions;

use psnXT\Helpers;
use psnXT\Modules\Install\Tasks\InstallTask;
use psnXT\Modules\Install\Tasks\SeedTablesTask;
use psnXT\Modules\Install\Tasks\SendInstallationMailTask;
use psnXT\Modules\Install\UI\Web\Requests\Install;
use psnXT\Modules\Setting\Tasks\UpdateEnvTask;
use Ramsey\Uuid\Uuid;

/**
 * Class InstallAction
 * @package psnXT\Modules\Install\Actions
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
            'password' => Helpers::generatePassword()
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
