<?php
namespace App\helpers;

use Illuminate\Support\Facades\Http;

class AuthHelper
{
    public static function oAuthToken($credentials)
    {
        return Http::asForm()->post(config('app.services.auth_api.url') . '/token', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
            'username' => $credentials['email'],
            'password' => $credentials['password'],
            'scope' => ''
        ])->json();
    }

    public static function oAuthRefreshToken($refreshToken)
    {
        return Http::asForm()->post(config('app.services.auth_api.url') . '/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
            'scope' => '',
        ])->json();
    }

    public static function revokeAccessAndRefreshTokens($tokenId)
    {
        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
        $tokenRepository->revokeAccessToken($tokenId);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);
    }

    public static function checkUserProfile($user)
    {
        if (!$user || !$user->profile?->exists() || !$user->active)
            return false;
        return true;
    }
}