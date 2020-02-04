<?php

namespace Modules\Tenant\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 * @package Modules\Tenant\UI\Web\Requests
 */
class StoreRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'tenant'      => 'required|max:120',
            'user_quota'  => 'integer',
            'street'      => 'max:120',
            'housenumber' => 'max:20',
            'postalcode'  => 'max:5',
            'location'    => 'max:80',
            'email'       => 'required|email|max:120',
            'telephone'   => 'max:20',
            'mobile'      => 'max:20',
            'website'     => 'nullable|url|max:120',
            'connection'  => 'required',
            'hostname'    => 'required',
            'port'        => 'nullable|integer|between:1,65535',
            'database'    => 'required',
            'username'    => 'required',
            'password'    => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'tenant.required'     => 'Bitte geben Sie eine Bezeichnung für den Mandanten ein!',
            'tenant.max'          => 'Die angegebene Bezeichnung für den Mandanten ist zu lang (max. :max Zeichen).',
            'user_quota.integer'  => 'Die angegebene Anzahl der Benutzer ist keine Zahl.',
            'street.max'          => 'Die angegebene Straße des Mandanten ist zu lang (max. :max Zeichen).',
            'housenumber.max'     => 'Die angegebene Hausnummer des Mandanten ist zu lang (max. :max Zeichen).',
            'postalcode.max'      => 'Die angegebene Postleitzahl des Mandanten ist zu lang (max. :max Zeichen).',
            'location.max'        => 'Der angegebene Ort des Mandanten ist zu lang (max. :max Zeichen).',
            'email.required'      => 'Bitte geben Sie eine E-Mail Adresse für den Mandanten an!',
            'email.email'         => 'Die angegebene E-Mail Adresse des Mandanten entspricht keinem gültigem Format.',
            'email.max'           => 'Die angegebene E-Mail Adresse des Mandanten ist zu lang (max. :max Zeichen).',
            'telephone.max'       => 'Die angegebene Telefonnummer des Mandanten ist zu lang (max. :max Zeichen).',
            'mobile.max'          => 'Die angegebene Mobilnummer des Mandanten ist zu lang (max. :max Zeichen).',
            'website.url'         => 'Die angegebene Website des Mandanten entspricht keinem gültigem Format.',
            'website.max'         => 'Die angegebene Website des Mandanten ist zu lang (max. :max Zeichen).',
            'connection.required' => 'Bitte geben Sie einen Namen für die Datenbankverbindung des Mandanten an!',
            'port.integer'        => 'Der angegebene Port ist keine Zahl.',
            'port.between'        => 'Der angegebene Port muss zwischen 1 und 65535 liegen.',
            'hostname.required'   => 'Bitte geben Sie einen Hostnamen für die Datenbankverbindung des Mandanten an!',
            'database.required'   => 'Bitte geben Sie einen Datenbanknamen für die Datenbankverbindung des Mandanten an!',
            'username.required'   => 'Bitte geben Sie einen Benutzernamen für die Datenbankverbindung des Mandanten an!',
            'password.required'   => 'Bitte geben Sie ein Passwort für die Datenbankverbindung des Mandanten an!',
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('tenant-index')->with([
            'success' => 'Der Mandant wurde erfolgreich erstellt.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('tenant-create')->with([
            'error' => 'Der Mandant konnte aufgrund einer technischen Störung nicht erstellt werden.'
        ])->withInput();
    }
}