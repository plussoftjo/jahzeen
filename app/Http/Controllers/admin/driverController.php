<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class driverController extends Controller
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
    	User::where('id',$user->id)->update([
    		'type' =>1
    	]);
        $success['token'] =  $user->createToken('jahzeen')-> accessToken; 
    	return response()->json(['msg' => 'success','success' => $success['token']],200);
    }

    public function index() {
    	return response()->json(User::where('type',1)->get());
    }
}
