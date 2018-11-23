<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\serviceUser;
use Auth;
use App\price;
use App\userNumbers;
use App\User;
class checkoutController extends Controller
{
    public function fetchUserBags() 
    {
    	return response()->json(serviceUser::where('user_id',Auth::id())->get());
    }
    public function showServicePrice($id)
    {
    	return response()->json(userNumbers::where('user_id', Auth::id())->where('sub_service_id',$id)->get());
    }
}
