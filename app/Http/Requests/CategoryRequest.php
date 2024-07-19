<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        // Si es una solicitud de actualización, se valida que lleve ID
        if ($this->isMethod('PUT')) {
            $rules['id'] = 'required|numeric|exists:categories,id';
        }

        return $rules;
    }

    public function attributes()
    {
        return [

            'name'=> 'Nombre',
            'description' => 'descripción',


        ];
    }

    public function messages()
    {

        return [

            'name.required'=> 'El nombre de la categoría es requerido',
            'description.required'=> 'La Descripción de la categoría es requerida'

        ];
    }

    public function failedValidation(Validator $validator) {
        // Pasamos en json los errores del request
       throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
   }
}
