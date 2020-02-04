<?php

namespace Modules\Navigation\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    protected $redirectRoute = 'navigation-index';

    public function rules()
    {
        return [
            'uuid' => 'required|uuid|exists:navigation,uuid'
        ];
    }

    public function messages()
    {
        return [
            'uuid.required' => 'Es wurde keine UUID übergeben.',
            'uuid.uuid'     => 'Die übergebene UUID ist ungültig.',
            'uuid.exists'   => 'Das zu bearbeitende Element existiert nicht.'
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
     * Inject GET parameter "type" into validation data
     *
     * @param array $keys Properties to only return
     *
     * @return array
     */
    public function all($keys = null)
    {
        $data         = parent::all($keys);
        $data['uuid'] = $this->route('uuid');

        return $data;
    }
}