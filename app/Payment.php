<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function sport(){
    	return $this->belongsTo('App\Sport');
    }

    public function coach(){
    	return $this->belongsTo('App\User', 'coach_id');
    }
}
