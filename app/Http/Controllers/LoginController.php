<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $response = Http::post('https://reqres.in/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (isset( $response['error'] ) ) {
            return $response;
        } else {
            $user = User::where('email', $request->email)->get();

            if (!empty($user)) {
                User::create([
                    'name' => "",
                    'email' => $request->email,
                    'password' => $request->password,
                    'api_token' => $response['token'],
                ]);
            } else {
                User::where('email', $request->email)
                    ->update(['api_token' => $response['token']]);
            }
            return $response;
        }

    }
}
