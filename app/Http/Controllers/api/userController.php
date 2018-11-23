<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class userController extends Controller
{
    public function reg(Request $req)
    {
    	 $validator = Validator::make($req->all(), [ 
            'name' => 'required|min:4|max:32', 
            'phone' => 'required|unique:users|min:4|max:32', 
            'password' => 'required', 
       	 ]);
       	 if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
    	$user = User::create([
    		'name' => $req->name,
    		'phone' => $req->phone,
    		'password' => Hash::make($req->password)
    	]);
        $success['token'] =  $user->createToken('jahzeen')-> accessToken; 
    	return response()->json(['msg' => 'success','success' => $success['token']],200);
    }


    public function login() {
        if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('jahzeen')-> accessToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    public function details()
    {
        return response()->json(Auth::User());
    }

    public function changePassword(Request $req)
    {
     $validator = Validator::make($req->all(), [ 
            'name' => 'required|min:4|max:32', 
            'phone' => 'required|unique:users|min:4|max:32', 
            'password' => 'required', 
         ]);
         if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        User::where('id',Auth::id())->update([
            'password' => Hash::make($req->password)
        ]);
    }
}
