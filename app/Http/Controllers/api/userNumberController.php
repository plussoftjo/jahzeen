<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\subService;
use App\price;
use App\userNumbers;
class userNumberController extends Controller
{
    public function save(Request $req,$id)
    {
        $i = 1;
    	foreach ($req->lastNumber as $k) {
    		$id =  price::where('sub_service_id',$id)->where('size',$k['e1'])->value('id');
            if(userNumbers::where('sub_service_id',$id)->where('user_id',Auth::id())->where('price_id',$id)->where('number',$i)->count() == 0)
            {
                userNumbers::create([
                'sub_service_id' => $id,
                'user_id' =>  Auth::id(),
                'price_id' => $id,
                'number' => $i
                ]);
            }
    		$i = $i + 1;
    	}
    }
}
