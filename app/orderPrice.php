<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderPrice extends Model
{
	public $with = ['price'];
     protected $fillable = [
    	'user_id','order_id','sub_service_id','price_id','number'
    ];
    public function price() {
    	return $this->belongsTo('App\price');
    }
}
