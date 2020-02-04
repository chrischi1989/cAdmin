<?php

namespace Modules\Install\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Install extends FormRequest
{
    private $dbConnections = ['mysql'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'APP_NAME'              => 'required',
            'APP_CUSTOMER'          => 'required',
            'APP_URL'               => 'required|url',
            'APP_CUSTOMER_BRANDING' => 'required|file|image',
            'DB_CONNECTION'         => 'required|in:' . implode(',', $this->dbConnections),
            'DB_HOST'               => 'required',
            'DB_PORT'               => 'sometimes|nullable|integer|between:1,65535',
            'DB_DATABASE'           => 'required',
            'DB_USERNAME'           => 'required',
            'DB_PASSWORD'           => 'required',
            'email'                 => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'APP_NAME.required'              => 'Bitte geben Sie einen Namen für die Anwendung ein!',
            'APP_CUSTOMER.required'          => 'Bitte geben Sie den Namen des Mandanten ein!',
            'APP_URL.required'               => 'Bitte geben Sie die vollständige URL der Installation ein!',
            'APP_URL.url'                    => 'Die angegebene URL hat ein ungültiges Format.',
            'APP_CUSTOMER_BRANDING.required' => 'Bitte geben Sie eine Datei für das Branding der Installation an!',
            'APP_CUSTOMER_BRANDING.file'     => 'Die angegebene Branding-Datei konnte nicht erfolgreich hochgeladen werden.',
            'APP_CUSTOMER_BRANDING.image'    => 'Die angegebene Branding-Datei ist keine gültige Bilddatei.',
            'DB_CONNECTION.required'         => 'Bitte wählen Sie den Datenbanktyp aus!',
            'DB_CONNECTION.in'               => 'Der angegebene Datenbanktyp ist ungültig.',
            'DB_HOST.required'               => 'Bitte geben Sie einen Hostnamen für die Datenbank an!',
            'DB_PORT.integer'                => 'Der angegebene Datenbankport ist keine Zahl.',
            'DB_PORT.between'                => 'Der angegebene Datenbankport muss zwischen :min und :max liegen.',
            'DB_DATABASE.required'           => 'Bitte geben Sie einen Datenbanknamen an!',
            'DB_USERNAME.required'           => 'Bitte geben Sie einen Benutzernamen für die Datenbank an!',
            'DB_PASSWORD.required'           => 'Bitte geben Sie ein Passwort für den Datenbankbenutzer an!',
            'email.required'                 => 'Bitte geben Sie die E-Mail Adresse des Administrator-Zuganges ein!',
            'email.email'                    => 'Die angegebene E-Mail Adresse entspricht keinem gültigem Format.'
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
        return redirect()->route('user-login-page')->with([
            'success' => 'Die Installation wurde erfolgreich abgeschlossen.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('setup')->with([
            'error' => 'Die Installation konnte aufgrund einer technischen Störung nicht abgeschlossen werden.'
        ])->withInput();
    }
}
