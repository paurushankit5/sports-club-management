<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Sport;
use App\SportUserClub;
use App\CoachFee;
use Mail;
use App\Mail\TestEmail;
use Session;



class PlayerController extends Controller
{
    public function dashboard(){
        return view('player.dashboard');
    }

    public function clubuser(){
        $users = User::where('club_id' , \Auth::user()->club_id)->with(['role','club'])->orderBy('users.id','DESC')->paginate(env('RESULT_LIMIT'));
        $array = array('users' => $users);
        return view('club.alluser',$array);


    }

    public function adduser(){
    	$roles = Role::where('is_global',1)->orderBy('role_name')->get();
    	$array = array('roles' => $roles);    	
    	return view('club.adduser',$array);
    }

    public function storeuser(Request $request)
    {
        if(!(\Auth::user()->is_superuser || \Auth::user()->role_id == 1)){
            return redirect('index');
        }
    	if($request->role == 0){        	
	    	$request->validate([
	            'role'         		=> 'required',            
	            'role_name'         => 'required',
	            'fname'             => 'required',
	            'lname'             => 'required',
	            'user_email'        => 'required|unique:users,email',
	            'user_mobile'       => 'required|unique:users,mobile',
	        ]);
	        $role = new Role;
	        $role->role_name = $request->role_name;
	        $role->is_global = false;
	        $role->save();
        }
        else if($request->role == 2 || $request->role == 10){  //2 is for player and 10 is for coach
            $request->validate([
                'role'              => 'required',            
                'fname'             => 'required',
                'lname'             => 'required',
                'sports'             => 'required',
                'user_email'        => 'required|unique:users,email',
                'user_mobile'       => 'required|unique:users,mobile',
            ]); 
            $role = Role::findOrFail($request->role);
        }
        else{

	    	$request->validate([
	            'role'         		=> 'required',            
	            'fname'             => 'required',
	            'lname'             => 'required',
	            'user_email'        => 'required|unique:users,email',
	            'user_mobile'       => 'required|unique:users,mobile',
	        ]);	
	        $role = Role::findOrFail($request->role);
        }
        try{
        	$user                       =   new User;
            $user->fname                =   ucfirst($request->fname);
            $user->lname                =   ucfirst($request->lname);
            $user->email                =   $request->user_email;
            $user->alternate_email      =   $request->user_alternate_email;
            $user->mobile               =   $request->user_mobile;
            $user->alternate_mobile     =   $request->user_alternate_mobile;
            $user->is_active            =   true;
            $user->role_id              =   $role->id;
            $user->club_id              =   \Auth::user()->is_superuser ? $request->club_id : \Auth::user()->club_id;
            $user->save();
            // echo "<pre>";
            // print_r($_REQUEST);
            // exit;
            //if the user is a coach set his/her initial fees to 0
            if($role->id == 10)
            {
                $coachFee = new CoachFee;
                $coachFee->user_id = $user->id;
                $coachFee->session_rate = 0;
                $coachFee->save();
            }

            if(count($request->sports))
            {
                foreach ($request->sports as $sport) {
                    $user_sport               = new SportUserClub;
                    $user_sport->sport_id     = $sport;
                    $user_sport->user_id      = $user->id;
                    $user_sport->save();
                }
            }


           $data = array('name'=> $user->fname." ".$user->lname, 'email' => $user->email  );
            
            Mail::to($user->email)->send(new TestEmail($data));
            Session::flash('alert-success', 'User added successfully');
            //echo "good";    
            return redirect(route('getoneuserprofile',$user->id));


        
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    public function getPlayerBySport($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
      
        //echo "<pre>";
        $array = array(
                        "club_id"   =>  \Auth::user()->club->id,
                        "role_id"   =>  2
                    );
        $users= User::where($array)
                        ->whereHas("sports", function($q){
                           $q->where("sports.id",request()->segment(4));
                        })->get();

        $array = array(
                        'users'  =>  $users,
                        "sport"  =>  $sport,
                        'user_type' => 'Members'   
                        );
        return view('user.getPlayerBySport',$array);
    }

    public function getCoachBySport($sport_id)
    {
        $sport = Sport::findOrFail($sport_id);
      
        //echo "<pre>";
        $array = array(
                        "club_id"   =>  \Auth::user()->club->id,
                        "role_id"   =>  10
                    );
        $users= User::where($array)
                        ->whereHas("sports", function($q){
                           $q->where("sports.id",request()->segment(4));
                        })->get();

        $array = array(
                        'users'  =>  $users,
                        "sport"  =>  $sport,
                        'user_type' => 'Coaches / Trainers'   

                        );
        return view('user.getPlayerBySport',$array);
    }

    
}
