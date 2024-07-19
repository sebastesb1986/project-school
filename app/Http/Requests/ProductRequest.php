<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
            'category_id' => 'required'
        ];

        // Si es una solicitud de actualización, se valida que lleve ID
        if ($this->isMethod('PUT')) {
            $rules['id'] = 'required|numeric|exists:products,id';
        }

        return $rules;
    }

    public function attributes()
    {
        return [

            'name'=> 'Nombre',
            'description' => 'descripción',
            'quantity'=> 'Cantidad',
            'category_id' => 'Categoría',

        ];
    }

    public function messages()
    {

        return [

            'name.required'=> 'El nombre del producto es requerido',
            'description.required'=> 'La Descripción del producto es requerida',
            'quantity.required'=> 'La cantidad para el producto es requerida',
            'quantity.integer'=> 'La cantidad para el producto debe ser númerica',
            'quantity.min'=> 'La cantidad para el producto debe ser minimo 1',
            'category_id.required'=> 'La categoría para el producto es requerida'

        ];
    }

    public function failedValidation(Validator $validator) {
        // Pasamos en json los errores del request
       throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
   }
}
