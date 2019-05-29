<?php

namespace App\Http\Middleware;

use App\Traits\JSONResponse;
use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JwtAuth
{

    use JSONResponse;

    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            $msg = 'Token not provided';
            return $this->sendErrorResponse($msg, null, 401);
        }
        try {
            $decoded = JWT::decode($token, env('JWT_SECRET'), array('HS512'));
            $request->auth = $decoded->sub;
            return $next($request);
        } catch(ExpiredException $e) {
            $msg = 'Token expired';
        } catch (\Exception $e) {
            $msg = 'Incorrect token';
        }
        return $this->sendErrorResponse($msg, null, 401);

    }
}
