<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\serviceUser;
use Auth;
use App\price;
class userServiceController extends Controller
{
    public function store(Request $req)
    {
    	if($req->add == false)
    	{
    		serviceUser::where('user_id',Auth::id())->where('sub_service_id',$req->id)->delete();
    	}else {
	    	if(serviceUser::where('user_id',Auth::id())->where('sub_service_id',$req->id)->count() == 0)
	    	{
	    		serviceUser::create([
	    			'user_id' => Auth::id(),
	    			'sub_service_id' => $req->id
	    		]);
	    	}else {
	    		// serviceUser::where('user_id',Auth::id())->where('sub_service_id',$req->id)->delete();
	    	}	
    	}
    	
    }

    public function index() 
    {
    	return response()->json(serviceUser::where('user_id',Auth::id())->get());	
    }

    public function show($id)
    {
    	return response()->json(price::where('sub_service_id',$id)->get());
    }
}
