<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'name' => 'nullable|string|max:255',
            'email' => 'required|exists:users,email',
            'phone' => 'nullable|min:7',
            'password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    // Obtén el correo electrónico
                    $email = $this->input('email');

                    // Busca al usuario por el correo electrónico
                    $user = User::where('email', $email)->first();

                    // Verifica la contraseña
                    if ($user && !Hash::check($value, $user->password)) {
                        $fail('La contraseña ingresada es incorrecta');
                    }

                },
            ],
        ];

        return $rules;
    }

    public function attributes()
    {
        return [

            'name'=> 'Nombre',
            'email' => 'Correo electrónico',
            'phone'=> 'Telefóno',
            'password' => 'Contraseña'

        ];
    }

    public function messages()
    {

        return [

            'email.required'=> 'El correo electrónico del usuario es requerida',
            'email.exists'=> 'El correo electrónico no se encuentra registrado',
            'password.required'=> 'La contraseña del usuario es requerido',
            'password.min'=> 'La cantidad de digitos para la contraseña debe ser mínimo :min',

        ];
    }

    public function failedValidation(Validator $validator) {
        // Pasamos en json los errores del request
       throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
   }
}
