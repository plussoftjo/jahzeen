<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subService extends Model
{

    public $with = ['service'];

    protected $fillable = [
    	'service_id','title','image'
    ];

    public function service() {
    	return $this->belongsTo('App\service');
    }

    public function prices()
    {
        return $this->hasMany('App\price');
    }

    public function serviceUsers()
    {
        return $this->hasMany('App\serviceUser');
    }

}
