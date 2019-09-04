<?php

namespace psnXT\Modules\User\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreRequest
 * @package psnXT\Modules\User\UI\Web\Requests
 */
class UpdateRequest extends FormRequest
{
    /**
     * @var array
     */
    private $salutations = ['Frau', 'Herr', 'Divers'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid'        => 'required|uuid|exists:users,uuid',
            'email'       => 'required|email',
            'password'    => 'sometimes|nullable|min:12|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/\d/|regex:/[\(\)\[\]\{\}\?\!\$\%\&\/\=\*\~\,\.\;\:\<\>\-\_]/',
            'salutation'  => 'required|in:' . implode(',', $this->salutations),
            'firstname'   => 'required|max:120',
            'lastname'    => 'required|max:120',
            'title'       => 'max:20',
            'street'      => 'max:200',
            'housenumber' => 'max:10',
            'postalcode'  => 'max:10',
            'location'    => 'max:120',
            'telephone'   => 'max:60',
            'cellphone'   => 'max:60'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'uuid.required'       => 'Es wurde keine UUID übergeben.',
            'uuid.uuid'           => 'Die übergebene UUID ist ungültig.',
            'uuid.exists'         => 'Der zu bearbeitende Benutzer existiert nicht.',
            'email.required'      => 'Bitte geben Sie eine E-Mail Adresse an!',
            'email.email'         => 'Die angegebene E-Mail Adresse entspricht keinem gültigem Format.',
            'email.unique'        => 'Es existiert bereits ein Benutzerkonto mit dieser E-Mail Adresse.',
            'password.required'   => 'Bitte geben Sie ein Passwort für das neue Benutzerkonto an!',
            'password.confirmed'  => 'Bitte bestätigen Sie das angegebene Passwort.',
            'password.min'        => 'Das angegebene Password muss mindestens :min Zeichen betragen.',
            'password.regex'      => 'Das angegebene Password entspricht nicht den geforderten Richtlinien.',
            'salutation.required' => 'Bitte wählen sie eine Anrede aus!',
            'salutation.in'       => 'Die angegebene Anrede ist ungültig.',
            'firstname.required'  => 'Bitte geben Sie einen Vornamen an!',
            'firstname.max'       => 'Der angegebene Vorname ist zu lang (max. :max Zeichen).',
            'lastname.required'   => 'Bitte geben Sie einen Nachnamen an!',
            'lastname.max'        => 'Der angegebene Nachname ist zu lang (max. :max Zeichen).',
            'title.max'           => 'Der angegebene Titel ist zu lang (max. :max Zeichen).',
            'street.max'          => 'Die angegebene Straße ist zu lang (max. :max Zeichen).',
            'housenumber.max'     => 'Die angegebene Hausnummer ist zu lang (max. :max Zeichen).',
            'postalcode.max'      => 'Die angegebene Postleitzahl ist zu lang (max. :max Zeichen).',
            'location.max'        => 'Der angegebene Ort ist zu lang (max. :max Zeichen).',
            'telephone.max'       => 'Die angegebene Telefonnummer ist zu lang (max. :max Zeichen).',
            'cellphone.max'       => 'Die angegebene Mobilnummer ist zu lang (max :max Zeichen).'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        return redirect()->route('user-edit', ['uuid' => $this->post('uuid')])->with([
            'success' => 'Der Benutzer wurde erfolgreich bearbeitet.'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failed()
    {
        return redirect()->route('user-edit', ['uuid' => $this->post('uuid')])->withInput()->with([
            'error' => 'Der Benutzer konnte aufgrund einer technischen Störung nicht bearbeitet werden.'
        ]);
    }
}
