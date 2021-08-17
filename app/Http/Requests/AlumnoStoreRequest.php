<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class AlumnoStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:alumnos',
            'payment_status' => 'in:Paid,Pending',
            'is_ecuadorian' => 'required|boolean',
            'assistance' => 'boolean',
            'phone' => 'required|string',
            'empresa_id' => 'required|exists:empresas,id'
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

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'code' => Response::HTTP_BAD_REQUEST,
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST)
        );
    }
}
