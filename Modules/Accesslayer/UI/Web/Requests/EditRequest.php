<?php

namespace Modules\Accesslayer\UI\Web\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditRequest
 * @package Modules\User\UI\Web\Requests
 */
class EditRequest extends FormRequest
{
    protected $redirectRoute = 'accesslayer-index';

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
            'uuid.exists'   => 'Die zu bearbeitende Zugriffsebene existiert nicht.'
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
