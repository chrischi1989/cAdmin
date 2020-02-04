<?php

namespace Modules\Accesslayer\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DestroyRequest
 * @package Modules\Accesslayer\UI\Web\Requests
 */
class DestroyRequest extends FormRequest
{
    protected $redirectRoute = 'accesslayer-index';

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|uuid|exists:accesslayer,uuid'
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
            'uuid.exists'   => 'Die zu löschende Zugriffsebene existiert nicht.'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('accesslayer-index')->with([
            'error' => 'Die Zugriffsebene konnte aufgrund einer technischen Störung nicht gelöscht werden.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('accesslayer-index')->with([
            'success' => 'Die Zugriffsebene wurde erfolgreich gelöscht.'
        ]);
    }
}
