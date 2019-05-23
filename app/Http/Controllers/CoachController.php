<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SportUserClub;
use App\User;
use App\Sport;
use App\Session;

class CoachController extends Controller
{
	public function dashboard(){
		return view('coach.dashboard');
	}

    public function myplayers($sport_id){
        $sport  =   Sport::findOrFail($sport_id);
    	$array = array(
    					"sport_id"	=> 	$sport_id,
    					"coach_id"	=>	\Auth::user()->id
    				);
		\DB::connection()->enableQueryLog();
    	$user_ids = 	SportUserClub::where($array)->select('user_id')->get();
    	//print_r( \DB::getQueryLog());
    	$users = 	User::whereIn('id', $user_ids)->get();

        $coaches = User::where('role_id', 10)
                        ->whereHas('sports', function($q) {
                            $q->where('sports.id',  request()->segment(3));
                        })
                        ->get();
    	$array 	= array('users' => $users,
                        'sport' =>  $sport,
                        'coaches'   => $coaches
                        );
    	return view('coach.myplayers', $array);
    }

    public function add_session(Request $request){
        $user = User::findOrFail($request->user_id);
        $coach = User::findOrFail($request->coach_id);
        $session = new Session;
        $session->sport_id   =   $request->sport_id;
        $session->user_id   =   $request->user_id;
        $session->coach_id   =   $request->coach_id;
        $session->session_date      =   $request->date;
        $session->session_charge      =   $coach->coachfees->session_rate;
        $session->session_count      =   $request->session_count;
        $session->final_amount      =   $request->session_count*$coach->coachfees->session_rate;
        $session->save();

        $user->advance_amount = $user->advance_amount - $session->final_amount;
        $user->save();
        
        return 1;
    }
}
