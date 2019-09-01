<?php

namespace psnXT\Modules\Navigation\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package psnXT\Modules\Navigation\UI\Web\Requests
 */
class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon'  => 'required',
            'title' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'icon.required'  => 'Bitte wählen Sie ein Icon für das Navigationselement aus!',
            'title.required' => 'Bitte geben Sie einen Text für das Navigationselement an!'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('navigation-create')->withInput()->with([
            'error' => 'Das Navigationselement konnte aufgrund einer technischen Störung nicht erstellt werden.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('navigation-index')->with([
            'success' => 'Das Navigationselement wurde erfolgreich erstellt.'
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