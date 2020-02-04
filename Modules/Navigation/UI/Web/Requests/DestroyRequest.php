<?php

namespace Modules\Navigation\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package Modules\Navigation\UI\Web\Requests
 */
class DestroyRequest extends FormRequest
{
    protected $redirectRoute = 'navigation-index';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|uuid|exists:navigation,uuid',
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
            'uuid.exists'   => 'Das zu löschende Navigationselement wurde nicht gefunden.',
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('navigation-index')->with([
            'error' => 'Das Navigationselement konnte aufgrund einer technischen Störung nicht gelöscht werden.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('navigation-index')->with([
            'success' => 'Das Navigationselement wurde erfolgreich gelöscht.'
        ]);
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
}