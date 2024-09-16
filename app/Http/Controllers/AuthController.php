<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'remember_me' => 'boolean',
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($request->remember_me) auth()->factory()->setTTL(20160);

        return $this->respondWithToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Verify the user email.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        try {
            $request->fulfill();

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
        $user = User::where('email', $request->email)->first();

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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
