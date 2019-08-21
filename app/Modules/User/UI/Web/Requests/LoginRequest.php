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
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'    => 'Bitte geben Sie einen E-Mail Adresse an!',
            'email.email'       => 'Die angegebene E-Mail Adresse entspricht keinem gültigem Format.',
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('dashboard')->with([
            'success' => 'Sie wurden erfolgreich angemeldet.'
        ]);
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
        return redirect()->route('user-reset-password-page', ['token' => session('password_reset_token')])->with([
            'info' => 'Ihr Passwort ist abgelaufen. Bitte erstellen Sie ein neues Passwort.'
        ]);
    }
}
