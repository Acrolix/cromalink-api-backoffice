<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserProfileRequest extends FormRequest
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
            'first_name' => 'string|max:30',
            'last_name' => 'string|max:30',
            'country_code' => 'string|max:4',
            'biography' => 'text',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:5120', 
        ];
    }

    public function messages()
    {
        return [
            'first_name.string' => 'El campo nombre debe ser una cadena de texto',
            'first_name.max' => 'El campo nombre no debe exceder los 30 caracteres',
            'last_name.string' => 'El campo apellido debe ser una cadena de texto',
            'last_name.max' => 'El campo apellido no debe exceder los 30 caracteres',
            'country_code.string' => 'El campo código de país debe ser una cadena de texto',
            'country_code.max' => 'El campo código de país no debe exceder los 4 caracteres',
            'biography.text' => 'El campo biografía debe ser una cadena de texto',
            'avatar.image' => 'El campo avatar debe ser una imagen',
            'avatar.mimes' => 'El campo avatar debe ser una imagen de tipo: jpeg, png, jpg',
            'avatar.max' => 'El campo avatar no debe exceder los 5120 KB',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Error de validación',
            'errors'      => $validator->errors()
        ], 400));
    }
}
