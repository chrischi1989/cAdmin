<?php

namespace psnXT\Modules\User\Tasks;

use Mail;
use psnXT\Modules\User\Mails\ResetPasswordMail;
use psnXT\Modules\User\Models\User;

/**
 * Class SendPasswordResetEmailTask
 * @package psnXT\Modules\User\Tasks
 */
class SendPasswordResetEmailTask
{
    /**
     * @var ResetPasswordMail
     */
    private $resetPasswordMail;

    /**
     * SendPasswordResetEmailTask constructor.
     * @param ResetPasswordMail $resetPasswordMail
     */
    public function __construct(ResetPasswordMail $resetPasswordMail)
    {
        $this->resetPasswordMail = $resetPasswordMail;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function run(User $user)
    {
        return Mail::to($user->email_encrypted)->send($this->resetPasswordMail);
    }
}
