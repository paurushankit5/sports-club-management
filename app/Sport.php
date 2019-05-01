<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sport extends Model
{
    use SoftDeletes;

    public function clubs()
    {
    	return $this->belongsToMany('App\Club');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
