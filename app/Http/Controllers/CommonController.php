<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CommonController extends Controller
{
    public static function checkClubAdminOrSuperUser(User $user){
    	return  (\Auth::check() && (\Auth::user()->is_superuser || (\Auth::user()->role_id == 1 && \Auth::user()->club_id = $user->club_id ))) ? true : false;
    }
}
