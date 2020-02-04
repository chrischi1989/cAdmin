<?php

namespace Modules\Install\Tasks;

use Mail;
use Modules\Install\Mails\InstallationMail;

/**
 * Class SendInstalltionMailTask
 * @package Modules\Install\Tasks
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
