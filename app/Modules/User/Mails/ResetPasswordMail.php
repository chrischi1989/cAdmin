<?php

namespace psnXT\Modules\User\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    private $token;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@psnmedia.cloud')
                    ->subject('Zurücksetzen Ihres Passwortes auf ' . env('APP_URL'))
                    ->view('User.UI.Web.Views.mails.password-reset', [
                        'token' => session('password_reset_token')
                    ]);
    }
}
