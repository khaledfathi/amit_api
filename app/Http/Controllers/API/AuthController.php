<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login 
    public function login (Request $request){
        if (Auth::attempt(['email'=>$request->email ,'password'=> $request->password])){
            $token = $request->user()->createToken('token');
            $record = UserModel::where('email' , $request->email)->first(); 
            return response()->json([
                'token'=>$token->plainTextToken,
                'user' => $record
            ]); 
        }else {
            return response()->json([
                'error'=>'invalid email or password'
            ]);
        }
    }
    //logout
    public function logout (){
        Auth::logout(); 
    }
}
