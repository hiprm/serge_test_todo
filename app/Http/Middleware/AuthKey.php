<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        $token = $request->header('token');
//        return $token;
//        $user = User::where('api_token', $token)->get();
//
//
//        if (!empty($user)) {
//            return $next($request);
//        } else {
//           return "Invalid";
//        }

    }
}
