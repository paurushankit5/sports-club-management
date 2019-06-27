<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function users(){
    	return $this->belongsTo('App\User', 'coach_id')->orderBy('fname');
    }

    public function player(){
    	return $this->belongsTo('App\User', 'user_id')->orderBy('fname');
    }

    public function sport(){
    	return $this->belongsTo('App\Sport');
    }
}
