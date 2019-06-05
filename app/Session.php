<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function users(){
    	return $this->belongsTo('App\User', 'coach_id')->orderBy('fname');
    }
}
