<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 3|ul0aGWfpJHoeJ6ZJjJ5HeWno0S927ZkotpFslsdG1f9680cb invoice
//4|FgHxZCn8KYLRSVgmrHXCRGlDpi70zlz2Z5mofA3Ja9140fc1 user

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    { 
        if (Auth::attempt($request->only('email', 'password'))){
            return $this->response('Authorized', 200, [
                'token' => $request->user()->createToken('invoice')->plainTextToken
            ]);
        }

        return $this->response('Not Authorized', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked', 200);
    }
}
