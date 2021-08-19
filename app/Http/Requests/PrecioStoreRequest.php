<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class PrecioStoreRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|unique:precios,type|in:Becado,Pre-venta,Regular',
            'cost' => 'required|numeric',
            'active' => 'boolean'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'type.in' => 'The type selected is not valid, it is only accepted: Becado,Pre-venta,Regular ',
        ];
    }

}
