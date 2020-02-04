<?php

namespace Modules\User\Tasks;

use Mail;
use Modules\User\Mails\CredentialMail;
use Modules\User\Models\User;

class SendCredentialEmailTask
{
    private $credentialMail;

    public function __construct(CredentialMail $credentialMail)
    {
        $this->credentialMail = $credentialMail;
    }

    public function run(User $user)
    {
        $this->credentialMail->setUser($user);

        return Mail::to($user->email_encrypted)->send($this->credentialMail);
    }
}
