<?php

namespace App\Http\Middleware;

use App\Traits\JSONResponse;
use App\Utils\Error;
use Closure;

class AdminAuth
{

    use JSONResponse;

    public function handle($request, Closure $next)
    {
        $user = $request->auth->role;
        if ($user !== 'admin') {
            return $this->sendErrorResponse(Error::NOT_ADMIN, null, 401);
        }
        return $next($request);
    }
}
