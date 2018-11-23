<?php

namespace App\Http\Controllers\driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
class userController extends Controller
{
     public function login() {
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('jahzeen')-> accessToken;
            if($user->type == 0) {
            return response()->json(['error'=>'Unauthorised'], 401); 
            } 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
}
