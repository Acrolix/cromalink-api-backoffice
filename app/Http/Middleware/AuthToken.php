<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->bearerToken();

            if (!$token)
                return response()->json(['message' => 'Token no proporcionado'], 401);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->post(config('app.services.auth_api.url') . '/verify');

            $data = json_decode($response, true);

            if ($data['status'] === 'valid') {
                $request->setUserResolver(function () use ($data) {
                    return User::find($data['user']);
                });
                return $next($request);
            }

            return response()->json(['message' => 'Token inválido'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al validar el token'], 500);
        }
    }
}
