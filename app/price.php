<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
	public $with = ['subService'];
    protected $fillable = [
    	'sub_service_id','size'
    ];

    public function subService() {
    	return $this->belongsTo('App\subService');
    }
}
