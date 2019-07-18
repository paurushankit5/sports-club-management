<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function club(){
        return $this->belongsTo('App\Club');
    }
    
    public function sports(){
        return $this->belongsToMany('App\Sport','sport_user_club')->withPivot('coach_id');
    }

    public function coachfees(){
        return $this->hasOne('App\CoachFee');
    }

    public function recordpayments()
    {
        return $this->hasMany('App\RecordPayment')->orderBy('payment_date','DESC')->orderBy('created_at', 'DESC');
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

     public function payments2(){
        return $this->hasMany('App\Payment');
    }

    public function release_invoice(){
        return $this->hasOne('App\ReleaseInvoice');
    }

    public function getFullName(){
        return $this->fname." ".$this->lname;
    }

    public function getFullNameWithAnchor(){
        return "<a href='".route('getoneuserprofile', $this->id)."' target='_blank'>".$this->fname." ".$this->lname."</a>";
    }

}
