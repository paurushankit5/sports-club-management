<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
	use SoftDeletes;
    public function users(){
    	return $this->hasMany('App\User');
    }

    public function sports(){
    	return $this->belongsToMany('App\Sport','sport_user_club');
    }
}
