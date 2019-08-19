<?php

namespace psnXT\Modules\Install\Tasks;

use Mail;

/**
 * Class SendInstalltionMailTask
 * @package psnXT\Modules\Install\Tasks
 */
class SendInstalltionMailTask
{
    /**
     * @var
     */
    private $installationMail;

    /**
     * SendInstalltionMailTask constructor.
     * @param $installationMail
     */
    public function __construct($installationMail)
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
