<?php


namespace App\Traits;

use Firebase\JWT\JWT;

trait JWTDecoder
{

    public function decodeToken($token)
    {
        $decoded = JWT::decode($token, env('JWT_SECRET'), array('HS512'));
        return $decoded->sub;
    }
}