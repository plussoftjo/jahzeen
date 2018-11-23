<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userNumbers extends Model
{
	public $with = ['price'];
    protected $fillable = [
    	'sub_service_id','user_id','price_id','number'
    ];

    public function price() {
    	return $this->belongsTo('App\price');
    }
}
