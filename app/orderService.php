<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderService extends Model
{
	public $with = ['subService'];
    protected $fillable = [
    	'user_id','order_id','sub_service_id'
    ];
     public function subService() {
    	return $this->belongsTo('App\subService');
    }
}
