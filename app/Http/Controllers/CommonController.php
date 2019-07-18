<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CommonController extends Controller
{
    public static function checkClubAdminOrSuperUser(User $user){
    	return  (\Auth::check() && (\Auth::user()->is_superuser || (\Auth::user()->role_id == 1 && \Auth::user()->club_id == $user->club_id ))) ? true : false;
    }

    public static function checkSuperUserOrCoach(User $user){
    	return  (\Auth::check() && (\Auth::user()->is_superuser || (\Auth::user()->role_id == 10 && \Auth::user()->club_id == $user->club_id ))) ? true : false;
    }

    public static function checkSuperUserOrClubOrCoachOrPlayer (User $user){
    	return  (\Auth::check() && (\Auth::user()->is_superuser || ( \Auth::user()->club_id == $user->club_id  && (\Auth::user()->role_id == 10 && \Auth::user()->role_id == 1) || (\Auth::user()->id == $user->id ) ))) ? true : false;
    }

    
}
