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
            'phone' => 'required|min:7',
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
            'email.required'=> 'El correo electrónico del usuario es requerida',
            'phone.required'=> 'El telefono del usuario es requerido',
            'phone.min'=> 'La cantidad de digitos para teléfono debe ser mínimo 7',

        ];
    }

    public function failedValidation(Validator $validator) {
        // Pasamos en json los errores del request
       throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
   }
}
