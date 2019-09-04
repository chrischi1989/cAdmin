<?php

namespace psnXT\Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DestroyRequest
 * @package psnXT\Modules\User\UI\Web\Requests
 */
class DestroyRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|uuid|exists:users,uuid'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'uuid.required' => 'Es wurde keine UUID übergeben.',
            'uuid.uuid'     => 'Die übergebene UUID ist ungültig.',
            'uuid.exists'   => 'Der zu bearbeitende Benutzer existiert nicht.'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
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
        return redirect()->route('user-index')->with([
            'success' => 'Der Benutzer wurde erfolgreich gelöscht.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('user-index')->with([
            'error' => 'Der Benutzer konnte aufgrund einer technischen Störung nicht gelöscht werden.'
        ]);
    }
}
