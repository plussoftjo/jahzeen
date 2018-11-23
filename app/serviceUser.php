<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class serviceUser extends Model
{
	public $with = ['subService'];
    protected $fillable = [
    	'user_id','sub_service_id'
    ];

    public function subService() {
    	return $this->belongsTo('App\subService');
    }

}
