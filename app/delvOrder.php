<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delvOrder extends Model
{
    	public $with =  ['User'];
    protected $fillable = [
    	'user_id','location','date','time','order_id','driver','type'
    ];

     public function User() {
    	return $this->belongsTo('App\User');
    }
}
