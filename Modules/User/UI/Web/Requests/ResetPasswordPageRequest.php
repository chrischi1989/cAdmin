<?php

namespace Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordPageRequest
 * @package Modules\User\UI\Web\Requests
 */
class ResetPasswordPageRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $redirectRoute = 'user-login-page';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required|exists:users_password_resets,token'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'token.required' => 'Es wurde kein Token übergeben.',
            'token.exists'   => 'Es wurde keine Anfrage zum Zurücksetzen des Passwortes gefunden.'
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
     * Inject GET parameter "type" into validation data
     *
     * @param array $keys Properties to only return
     *
     * @return array
     */
    public function all($keys = null)
    {
        $data          = parent::all($keys);
        $data['token'] = $this->route('token');

        return $data;
    }
}
