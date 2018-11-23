<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use App\orderService;
use App\price;
use App\userNumbers;
use App\serviceUser;
use App\orderPrice;
use Stripe;
class orderController extends Controller
{
	public function store(Request $req)
	{
	   $order =  order::create([
	    	'user_id' => Auth::id(),
	    	'location'=> $req->lngLat['lng'].','.$req->lngLat['lat'],
	    	'date' => $req->date,
	    	'time' => $req->time
	    ]);		
	   $id = $order->id;
	   $serviceUser = serviceUser::where('user_id',Auth::id())->get();
	   foreach ($serviceUser as $k) {
	   	orderService::create([
	   		'order_id' => $id,
	   		'user_id' => Auth::id(),
	   		'sub_service_id' => $k->sub_service_id
	   	]);
	   }
	   $userNumbers = userNumbers::where('user_id',Auth::id())->get();
	   foreach ($userNumbers as $k) {
	   	orderPrice::create([
	   		'order_id' => $id,
	   		'user_id' =>  Auth::id(),
	   		'sub_service_id' => $k->sub_service_id,
	   		'price_id' => $k->price_id,
	   		'number' => $k->number
	   	]);
	   }

	   //// delete other service
	   serviceUser::where('user_id',Auth::id())->delete();
	   userNumbers::where('user_id',Auth::id())->delete();

	}
	public function x(Request $req)
	{
		$charge = Stripe::charges()->create([
			'amount' => 3333,
			'description' =>'dsad',
			'source' => $req->token['id'],
			'currency' => 'USD',
			'receipt_email' => 'ahmad@altom.cm',
			'metadata' => [
				// 'contents' => 'sdsdsd',
				// 'quantity' => 1
			]
		]);
	}

}
