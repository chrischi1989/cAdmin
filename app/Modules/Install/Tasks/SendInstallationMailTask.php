<?php

namespace psnXT\Modules\Install\Tasks;

use Mail;
use psnXT\Modules\Install\Mails\InstallationMail;

/**
 * Class SendInstalltionMailTask
 * @package psnXT\Modules\Install\Tasks
 */
class SendInstallationMailTask
{
    /**
     * @var
     */
    private $installationMail;

    /**
     * SendInstalltionMailTask constructor.
     * @param $installationMail
     */
    public function __construct(InstallationMail $installationMail)
    {
        $this->installationMail = $installationMail;
    }

    /**
     * @param $to
     * @return mixed
     */
    public function run($to) {
        return Mail::to($to)->send($this->installationMail);
    }
}
