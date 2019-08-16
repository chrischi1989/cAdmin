<?php

namespace psnXT\Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules() {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Bitte geben Sie einen Benutzernamen an!',
            'password.required' => 'Bitte geben Sie ein Passwort an!'
        ];
    }

    public function authorize() {
        return true;
    }
}
