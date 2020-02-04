<?php

namespace Modules\Tenant\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatabaseRequest extends FormRequest
{
    protected $redirectRoute = 'tenant-index';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|uuid|exists:tenants_databases,uuid'
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
            'uuid.exists'   => 'Die zu migrierende Datenbank existiert nicht.'
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

    public function success()
    {
        return redirect()->route('tenant-index')->with([
            'success' => 'Die Datenbank des Mandanten wurde erfolgreich migriert.'
        ]);
    }

    public function failed()
    {
        return redirect()->route('tenant-index')->with([
            'error' => 'Die Datenbank des Mandanten konnte aufgrund einer technischen Störung nicht migriert werden.'
        ]);
    }
}