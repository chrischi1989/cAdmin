<?php

namespace Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LostPasswordRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Bitte geben Sie einen E-Mail Adresse an!',
            'email.email'    => 'Die angegebene E-Mail Adresse entspricht keinem gültigem Format.',
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
        return redirect()->route('user-lost-password-page')->with([
            'success' => 'Eine E-Mail mit Instruktionen zum zurücksetzen Ihres Passwortes wurde an die hinterlegte Adresse versendet.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('user-lost-password-page')->with([
            'error' => 'Ihre Anfrage zum zurücksetzen Ihres Passwortes konnte aufgrund einer technischen Störung nicht aufgenommen werden. Bitte wiederholen Sie den Vorgang zu einem späterem Zeitpunkt noch einmal.'
        ]);
    }
}
