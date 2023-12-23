<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login 
    public function login (Request $request){
        if (Auth::attempt(['email'=>$request->email ,'password'=> $request->password])){
            $token = $request->user()->createToken('token');
            return response()->json(['token'=>$token->plainTextToken]); 
        }
    }
    //logout
    public function logout (){
        Auth::logout(); 
    }
}
