<?php

namespace Modules\Accesslayer\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 * @package Modules\User\UI\Web\Requests
 */
class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'layer'    => 'required',
            'priority' => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'layer.required'    => 'Bitte geben Sie einen Namen der Zugriffsebene ein!',
            'priority.required' => 'Bitte geben Sie eine Prioriät für die Zugriffsebene ein!',
            'priority.integer'  => 'Die angegebene Priorität ist keine Zahl.'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('accesslayer-index')->with([
            'success' => 'Die Zugriffsebene wurde erfolgreich erstellt.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('accesslayer-create')->withInput()->with([
            'error' => 'Die Zugriffsebene konnte aufgrund einer technischen Störung nicht erstellt werden.'
        ]);
    }
}
