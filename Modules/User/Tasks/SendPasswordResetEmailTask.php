<?php

namespace Modules\User\Tasks;

use Mail;
use Modules\User\Mails\ResetPasswordMail;
use Modules\User\Models\User;

/**
 * Class SendPasswordResetEmailTask
 * @package Modules\User\Tasks
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
