<?php

namespace psnXT\Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package psnXT\Modules\User\UI\Web\Requests
 */
class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Bitte geben Sie einen Benutzernamen an!',
            'password.required' => 'Bitte geben Sie ein Passwort an!'
        ];
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *
     */
    public function success()
    {

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        $with = config('User.login_errors')->setting_value == 1 ? ['error' => 'Zugangsdaten unbekannt.'] : [];
        return redirect()->route('user-login-page')->with($with);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function passwordExpired()
    {
        return redirect()->route('user-reset-password-page', ['token' => 'TODO'])->with([
            'info' => 'Ihr Passwort ist abgelaufen. Bitte erstellen Sie ein neues Passwort.'
        ]);
    }
}
