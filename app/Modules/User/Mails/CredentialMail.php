<?php

namespace psnXT\Modules\User\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use psnXT\Modules\User\Models\User;

class CredentialMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@psnmedia.cloud')
                    ->subject('Ihre Zugangsdaten auf ' . env('APP_URL'))
                    ->view('user::mails.credentials', [
                        'user' => $this->user
                    ]);
    }
}
