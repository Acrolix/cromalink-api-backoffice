<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|regex:/^[\w.-]+@(cromalink\.)?acrolix\.tech$/',
            'password' => 'required|min:6',
            'remember_me' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El email es requerido!',
            'email.email' => 'El email debe ser válido!',
            'email.regex' => 'Solo se permite Email de la Empresa!',
            'password.required' => 'La contraseña es requerida!',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres!',
            'remember_me.boolean' => 'Debe seleccionar el checkbox!',
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
