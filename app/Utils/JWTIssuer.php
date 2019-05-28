<?php
/**
 * Created by PhpStorm.
 * User: abeeb
 * Date: 6/9/18
 * Time: 10:53 AM
 */

namespace App\Utils;

use Firebase\JWT\JWT;

class JWTIssuer
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function getPayloadClaims()
    {
        $payload = [
            'iss' => 'saloodo',
            'sub' => $this->data,
            'iat' => time(),
            'exp' => time() + 3600*100  //JWT lasts for 100 hours
        ];
        return $payload;
    }

    public function getToken()
    {
        $payload = $this->getPayloadClaims();
        $token = [
            'token' => JWT::encode($payload, env('JWT_SECRET'), 'HS512'),
            'expires' => $payload['exp']
        ];
        return $token;
    }
}