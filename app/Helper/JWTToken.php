<?php
namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function CreateToken($userEmail)
    {
        $key = env("JWT_KEY");
        $payload = [
            'iss' => "laravel-token",
            'iat' => time(),
            'exp' => time() * 60 * 60,
            'userEmail' => $userEmail
        ];
        $jwt = JWT::encode($payload, $key, "HS256");
        return $jwt;
    }

    public static function VerifyToken($token)
    {
        try {
            if ($token == null) {
                return "unauthorized";
            } else {
                $key = env("JWT_KEY");
                $decode = JWT::decode($token, new Key($key, "HS256"));
                return $decode;
            }
        } catch (\Exception $e) {
            return 'unauthorized';
        }
    }
}