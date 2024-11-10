<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:user_profile,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*.?&])[A-Za-z\d@$!%*.?&]{8,}$/',
            'password_confirmation' => 'required_with:password|string|min:8|same:password',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'country_code' => 'required|string|max:2|exists:country,code',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'El nombre de usuario es requerido!',
            'username.unique' => 'El nombre de usuario ya está en uso!',
            'email.required' => 'El email es requerido!',
            'email.email' => 'El email debe ser válido!',
            'email.unique' => 'El email ya está en uso!',
            'first_name.required' => 'El nombre es requerido!',
            'last_name.required' => 'El apellido es requerido!',
            'birth_date.required' => 'La fecha de nacimiento es requerida!',
            'birth_date.date' => 'La fecha de nacimiento debe ser válida!',
            'country_code.required' => 'El país es requerido!',
            'country_code.exists' => 'El país no es válido!',
            'password.required' => 'La contraseña es requerida!',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres!',
            'password.regex' => 'La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial!',
            'password_confirmation.same' => 'Las contraseñas no coinciden!',
            'password_confirmation.required_with' => 'La confirmación de contraseña es requerida!',
            
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
