<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'email' => 'required',
            'phone' => 'required|min:15',
        ];
        return $rules;
    }

    public function attributes()
    {
        return [

            'name'=> 'Nombre',
            'email' => 'Correo electrónico',
            'phone'=> 'Telefóno',

        ];
    }

    public function messages()
    {

        return [

            'name.required'=> 'El nombre de usuario es requerido',
            'email.required'=> 'La Descripción del producto es requerida',
            'phone.required'=> 'La cantidad para el producto es requerida',
            'phone.min'=> 'La cantidad para el producto debe ser minimo 15',

        ];
    }

    public function failedValidation(Validator $validator) {
        // Pasamos en json los errores del request
       throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
   }
}
