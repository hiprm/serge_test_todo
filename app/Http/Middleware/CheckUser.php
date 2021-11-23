<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckUser
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
        $token = $request->header('token');
        $user = User::where('api_token', $token)->get();

        if (count($user) > 0){
            return $next($request);
        }else{
            $json = array();
            $json['status']  = 'ERROR';
            $status_code = 401;
            $json['info']  = array("status" => $status_code, "error" => "Unauthorized");
            return response()->json($json, $status_code);

        }


    }
}
