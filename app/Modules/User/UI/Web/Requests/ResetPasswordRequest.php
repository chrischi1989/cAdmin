<?php

namespace psnXT\Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordPageRequest
 * @package psnXT\Modules\User\UI\Web\Requests
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'token'    => 'required|exists:users_password_resets,token',
            'password' => 'required|confirmed|min:12|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/|regex:/[\(\)\[\]\{\}\?\!\$\%\&\/\=\*\~\,\.\;\:\<\>\-\_]/',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'token.required'     => 'Es wurde kein Token übergeben.',
            'token.exists'       => 'Es wurde keine Anfrage zum Zurücksetzen des Passwortes gefunden.',
            'password.required'  => 'Bitte geben Sie ein neues Passwort ein!',
            'password.confirmed' => 'Die Passwortbestätigung stimmt nicht mit Ihrem angegebenen Passwort überein',
            'password.min'       => 'Das angegebene Passwort muss mindestens :min Zeichen lang sein.',
            'password.regex'     => 'Ihr angegebenes Passwort entspricht nicht den geforderten Kriterien.'
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function success()
    {
        return redirect()->route('user-login-page')->with([
            'success' => 'Ihr Passwort wurde erfolgreich zurückgesetzt.'
        ]);
    }

    public function failed() {
        return redirect()->route('user-reset-password-page', ['token' => $this->post('token')])->with([
            'error' => 'Ihr Passwort konnte aufgrund einer technischen Störung nicht geändert werden. Bitte wiederholen Sie den Vorgang zu einem späterem Zeitpunkt noch einmal.'
        ]);
    }
}
