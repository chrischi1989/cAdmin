<?php

namespace Modules\Navigation\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package Modules\Navigation\UI\Web\Requests
 */
class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid'  => 'required|uuid|exists:navigation,uuid',
            'icon'  => 'required',
            'title' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'uuid.required'  => 'Es wurde keine UUID übergeben.',
            'uuid.uuid'      => 'Die übergebene UUID ist ungültig.',
            'uuid.exists'    => 'Das zu bearbeitende Navigationselement wurde nicht gefunden.',
            'icon.required'  => 'Bitte wählen Sie ein Icon für das Navigationselement aus!',
            'title.required' => 'Bitte geben Sie einen Text für das Navigationselement an!'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('navigation-edit', ['uuid' => $this->post('uuid')])->withInput()->with([
            'error' => 'Das Navigationselement konnte aufgrund einer technischen Störung nicht bearbeitet werden.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('navigation-index')->with([
            'success' => 'Das Navigationselement wurde erfolgreich bearbeitet.'
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