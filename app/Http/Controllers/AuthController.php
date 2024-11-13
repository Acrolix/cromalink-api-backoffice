<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login the user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');

            
            $user = User::where('email', $credentials['email'])->first() or null;

            if (!AuthHelper::checkUserProfile($user)) 
                return response()->json(['message' => 'Usuario y/o contraseña inválida'], 401);
        
            $response = AuthHelper::oAuthToken($credentials);

            if (isset($response['error']))
                return response()->json(['message' => 'Usuario y/o contraseña inválida'], 401);

            $user->save_last_login();

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el Servidor'], 500);
        }
    }
    
    public function register(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        return response()->json([], 201);
    }

    public function validateToken()
    {
        return response()->json(request()->user());
    }

    public function logout(Request $request): JsonResponse
    {   
        try {
            AuthHelper::revokeAccessAndRefreshTokens($request->user()->token_id);
            return response()->json([], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => "Error al cerrar sesion"], 500);
        }
    }

    public function me() {
        $user = request()->user()->load('profile');
        $profile = [
            'id'=> $user->id,
            'last_login'=> $user->last_login,
            'email'=> $user->email,
            'first_name'=> $user->profile->first_name,
            'last_name'=> $user->profile->last_name,
            'role'=> $user->profile->role,
            'avatar'=> $user->profile->avatar,
        ];
        return $profile;
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        try {
            if ($request->user()->hasVerifiedEmail()) return response()->json(['message' => 'Email ya verificado'], 400);
            $request->fulfill();

            $user = $request->user();
            $user->active = true;
            $user->save();

            return response()->json([], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Link de verificación inválido'], 400);
        }
    }

    /**
     * Resend the email verification notification.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendEmailVerification(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email ya verificado'], 400);
        }

        if ($user) $user->sendEmailVerificationNotification();

        return response()->json([], 200);
    }
}
