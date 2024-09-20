<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
        return response()->json(Auth::user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
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

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
