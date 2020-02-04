<?php

namespace Modules\Accesslayer\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Update
 * @package Modules\Accesslayer\UI\Web\Requests
 */
class UpdateRequest extends FormRequest
{
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
            'uuid'     => 'required|uuid|exists:accesslayer,uuid',
            'layer'    => 'required',
            'priority' => 'required|integer|max:100'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'uuid.required'     => 'Es wurde keine UUID übergeben.',
            'uuid.uuid'         => 'Die übergebene UUID ist ungültig.',
            'uuid.exists'       => 'Die zu bearbeitende Zugriffsebene existiert nicht.',
            'layer.required'    => 'Bitte geben Sie einen Namen der Zugriffsebene ein!',
            'priority.required' => 'Bitte geben Sie eine Prioriät für die Zugriffsebene ein!',
            'priority.integer'  => 'Die angegebene Priorität ist keine Zahl.',
            'priority.max'      => 'Die angegebene Priorität darf nicht größer als :max sein.'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('accesslayer-edit', ['uuid' => $this->post('uuid')])->with([
            'error' => 'Die Zugriffsebene konnte aufgrund einer technischen Störung nicht bearbeitet werden.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('accesslayer-edit', ['uuid' => $this->post('uuid')])->with([
            'success' => 'Die Zugriffsebene wurde erfolgreich bearbetet.'
        ]);
    }
}
