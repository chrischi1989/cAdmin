<?php

namespace psnXT\Modules\Install\Actions;

use psnXT\Helpers;
use psnXT\Modules\Install\Tasks\InstallTask;
use psnxT\Modules\Install\Tasks\SeedTablesTask;
use psnXT\Modules\Install\Tasks\LockInstallerTask;
use psnXT\Modules\Install\Tasks\MigrateTablesTask;
use psnXT\Modules\Install\Tasks\SendInstalltionMailTask;
use psnXT\Modules\Install\UI\Web\Requests\Install;
use psnXT\Modules\User\Tasks\StoreUserTask;
use psnXT\Modules\Setting\Tasks\UpdateEnvTask;

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
     * @var MigrateTablesTask
     */
    private $migrateTablesTask;
    /**
     * @var SeedTablesTask
     */
    private $seedTablesTask;
    /**
     * @var InstallTask
     */
    private $installTask;
    /**
     * @var StoreUserTask
     */
    private $storeUserTask;
    /**
     * @var SendInstalltionMailTask
     */
    private $sendInstallationMailTask;
    /**
     * @var LockInstallerTask
     */
    private $lockInstallerTask;

    /**
     * InstallAction constructor.
     * @param UpdateEnvTask $updateEnvTask
     * @param MigrateTablesTask $migrateTablesTask
     * @param SeedTablesTask $seedTablesTask
     * @param InstallTask $installTask
     * @param StoreUserTask $storeUserTask
     * @param SendInstalltionMailTask $sendInstallationMailTask
     * @param LockInstallerTask $lockInstallerTask
     */
    public function __construct(
        UpdateEnvTask $updateEnvTask,
        MigrateTablesTask $migrateTablesTask,
        SeedTablesTask $seedTablesTask,
        InstallTask $installTask,
        StoreUserTask $storeUserTask,
        SendInstalltionMailTask $sendInstallationMailTask,
        LockInstallerTask $lockInstallerTask
    ) {
        $this->updateEnvTask            = $updateEnvTask;
        $this->migrateTablesTask        = $migrateTablesTask;
        $this->seedTablesTask           = $seedTablesTask;
        $this->installTask              = $installTask;
        $this->storeUserTask            = $storeUserTask;
        $this->sendInstallationMailTask = $sendInstallationMailTask;
        $this->lockInstallerTask        = $lockInstallerTask;
    }

    /**
     * @param Install $request
     * @return bool
     */
    public function run(Install $request)
    {
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
            $this->installTask->run();

            $adminUser = [
                'email'    => $request->post('email'),
                'password' => Helpers::generatePassword(),
            ];

            return $this->migrateTablesTask->run() &&
                   $this->seedTablesTask->run() &&
                   $this->storeUserTask->run($adminUser) &&
                   $this->sendInstallationMailTask->run($request->post('email')) &&
                   $this->lockInstallerTask->run();
        }

        return false;
    }
}
