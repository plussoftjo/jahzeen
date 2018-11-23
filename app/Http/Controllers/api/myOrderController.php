<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use App\orderPrice;
use App\orderService;
use App\User;

class myOrderController extends Controller
{
   public function index() 
   {
   	return response()->json(order::where('user_id',Auth::id())->get());
   }
   public function myBags($id)
   {
   	return response()->json(['bags' => orderService::where('order_id',$id)->get(), 'order' => order::where('id',$id)->first()]);
   }
   public function myNumbers($id,$order_id)
   {
   	return response()->json(orderPrice::where('order_id',$order_id)->where('user_id',Auth::id())->where('sub_service_id',$id)->get());
   }
   public function destroy($id)
   {
   	order::where('id',$id)->delete();
   	orderPrice::where('order_id',$id)->delete();
   	orderService::where('order_id',$id)->delete();
   }
}
