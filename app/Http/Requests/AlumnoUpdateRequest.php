<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class AlumnoUpdateRequest extends FormRequest
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
            'name' => 'string',
            'last_name' => 'string',
            'email' => Rule::unique('alumnos', 'email')->ignore($this->alumno),
            'payment_status' => 'in:Paid,Pending',
            'is_ecuadorian' => 'boolean',
            'assistance' => 'boolean',
            'phone' => 'string',
            'empresa_id' => 'exists:empresas,id'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'empresa_id.exists' => 'The selected company does not currently exist in the database.',
            'payment_status.in' => 'The selected payment status is invalid, only accepted: ' ."Paid ". 'or '. "Pending."
        ];
    }

}
