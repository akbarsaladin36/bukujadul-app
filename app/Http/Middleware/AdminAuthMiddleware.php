<?php

namespace App\Http\Middleware;

use App\Helper\Helper;
use Carbon\Carbon;
use Closure;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return Helper::GetResponse(401, 'Unauthorized token!');
        }

        $token = str_replace('Bearer ', '', $request->header('Authorization'));

        $checkToken = Helper::GetToken($token);

        if(!$checkToken) {
            return Helper::GetResponse(401, 'Token is not found!');
        }

        $expired_at = Carbon::parse($checkToken->session_expired_at);

        if($expired_at->isPast()) {
            return Helper::GetResponse(404, 'This token is expired!');
        }

        $checkUser = Helper::GetUserRole($checkToken->user_username);

        if($checkUser->user_role != 'admin') {
            return Helper::GetResponse(401, 'This process can be accessed by admin!');
        }

        $data =  [
            'user_uuid' => $checkToken->user_uuid,
            'user_username' => $checkToken->user_username,
            'user_role' => $checkUser->user_role,
            'user_status_cd' => $checkUser->user_status_cd,
            'session_start_at' => $checkToken->session_start_at,
            'session_expired_at' => $checkToken->session_expired_at,
            'session_token' => $checkToken->session_token
        ];

        $user = Helper::GetLoggedInUser($data);

        $request->attributes->add(['logged_in_user' => $user]);

        return $next($request);
    }
}
