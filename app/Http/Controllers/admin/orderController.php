<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use App\User;
use App\orderService;
use App\orderPrice;
use App\delvOrder;
class orderController extends Controller
{
    public function index() 
    {
    	return response()->json(order::get());
    }

    public function subServiceShow($id)
    {
    	return response()->json(orderService::where('order_id',$id)->get());
    }

    public function show($id)
    {
    	return response()->json(['order' => order::where('id',$id)->firstOrFail(), 'subService'=> orderService::where('order_id',$id)->get() ]);
    }

    public function orderPriceGet($id,$order_id)
    {
    	return response()->json(orderPrice::where('sub_service_id',$id)->where('order_id',$order_id)->get());
    }

    public function approveOrder($id,Request $req)
    {
    	$order = order::where('id',$id)->firstOrFail();
    	delvOrder::create([
    		'user_id' => $order->user_id,
    		'date' => $order->date,
    		'time' => $order->time,
    		'order_id' => $order->id,
    		'location' => $order->location,
            'driver' => $req->driver
    	]);
    	order::where('id',$id)->update(['type' => 1]);
    }

    public function indexApprove() 
    {
        return response()->json(delvOrder::where('type',0)->get());
    }

    public function subServiceShowApprove($id)
    {
        return response()->json(orderService::where('order_id',$id)->get());
    }

    public function showApprove($id)
    {
        return response()->json(['order' => delvOrder::where('order_id',$id)->firstOrFail(), 'subService'=> orderService::where('order_id',$id)->get() ]);
    }

    public function orderPriceGetApprove($id,$order_id)
    {
        return response()->json(orderPrice::where('sub_service_id',$id)->where('order_id',$order_id)->get());
    }

    public function indexComplate() 
    {
        return response()->json(delvOrder::where('type',1)->get());
    }
}
