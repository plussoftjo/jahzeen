<?php

namespace App\Http\Controllers\driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\delvOrder;
use Auth;
use App\User;
use App\orderService;
class orderController extends Controller
{
    public function index()
    {
    	$user = Auth::User();
    	return response()->json(delvOrder::where('driver',$user->name)->get());
    }

    public function showUser($id) 
    {
    	return respones()->json(User::where('user_id',$id)->firstOrFali());
    }

    public function show($id)
    {
    	$delvOrder = delvOrder::where('order_id',$id)->first();
    	$orderService = orderService::where('order_id',$id)->get();
    	return response()->json(['order' => $delvOrder,'bags' => $orderService]);

    }

    public function complateOrder($id)
    {
        delvOrder::where('order_id',$id)->update([
            'type' => 1
        ]);
    }
}
