<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	public $with =  ['User'];
    protected $fillable = [
    	'user_id','location','date','time'
    ];

     public function User() {
    	return $this->belongsTo('App\User');
    }
}
