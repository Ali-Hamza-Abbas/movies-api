<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use App\Helpers\v1\ApiResponseV1;

class AuthenticateSessionToken
{
    public function handle($request, Closure $next)
    {
        if (!$request->header('Authorization')) {
            return ApiResponseV1::error('Unauthorized', 401);
        }
    
        $authorizationHeader = $request->header('Authorization');
        $sessionToken = substr($authorizationHeader, strlen('Bearer '));
    
        $user = User::where('session_token', $sessionToken)->first();
    
        if (!$user) {
            return ApiResponseV1::error('Unauthorized', 401);
        }
    
        return $next($request);
    }
}