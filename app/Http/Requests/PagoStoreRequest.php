<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class PagoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'alumno_id' => 'required|exists:alumnos,id',
            'precio_id' => 'required|exists:precios,id',
            'observation' => 'string'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'alumno_id.exists' => 'The selected student does not currently exist in the database.',
            'precio_id.exists' => 'The selected price type does not currently exist in the database.'
        ];
    }

}
