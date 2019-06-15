<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Sport;
use App\Fee;
use App\Role;
use App\Club;
use App\Idproof;
use App\CoachFee;
use App\SportUserClub;
use App\Payment;
use App\PlayerMembership;
use PDF;
use PDF2;


class UserController extends Controller
{
	public function myprofile(){
		$idproofs  = Idproof::orderBy('proof_name')->get();
		$array 		= array(
							"idproofs"	=> $idproofs
						);		
        return view('user.myprofile', $array);
	}
	public function editprofile(){
		return view('user.editprofile');
	}
    public function updateProfilePic(Request $request){
    	$request->validate([
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    	try {
    		$user = \Auth::user();
    		if($user->profile_pic!='')
    		{
    			@unlink(public_path('/images/'.$user->profile_pic));
    		}
		  	$image = $request->file('profile_pic');
	        $profile_pic = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/images');
	        $image->move($destinationPath, $profile_pic);


	        $user->profile_pic = $profile_pic;
	        $user->save();
	        Session::flash('alert-success', 'Profile Pic updated successfully');
            return redirect(route('myprofile'));
	        
		}
		catch (\Exception $e) {
		    return $e->getMessage();
		}        
    }

    public function storeidproof(Request $request){
    	$request->validate([
                'id_proof_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'id_proof' 	   => 'required',
        ]);
    	try {
    		$user = \Auth::user();
    		if($user->id_proof_pic!='')
    		{
    			@unlink(public_path('/images/'.$user->id_proof_pic));
    		}
		  	$image = $request->file('id_proof_pic');
	        $id_proof_pic = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/images');
	        $image->move($destinationPath, $id_proof_pic);


	        $user->id_proof 	= $request->id_proof;
	        $user->id_proof_pic = $id_proof_pic;
	        $user->save();
	        Session::flash('alert-success', 'Profile Pic updated successfully');
            return redirect(route('myprofile'));
	        
		}
		catch (\Exception $e) {
		    return $e->getMessage();
		} 
    }
    public function updateprofile(Request $request)
    {
    	$request->validate([
            'fname'             		=> 'required',
            'lname'             		=> 'required',
            'user_alternate_email'      => 'nullable|email',
            'user_mobile'       		=> 'required|unique:users,mobile,'.\Auth::user()->id,
            'dob'						=> 'required|date'
        ]);	
    	try{
	    	$user = \Auth::user();
	    	$user->fname  =  	$request->fname;
	    	$user->lname  =  	$request->lname;
	    	$user->alternate_email  =  	$request->user_alternate_email;
	    	$user->mobile  =  	$request->user_mobile;
	    	$user->alternate_mobile  =  	$request->user_alternate_mobile;
	    	$user->emergency_contact_name  =  	$request->emergency_contact_name;
	    	$user->emergency_contact_number  =  	$request->emergency_contact_number;
	    	$user->blood_group  =  	$request->blood_group;
	    	$user->dob  =  	$request->dob;
	    	$user->save();
	    	Session::flash('alert-success', 'Profile updated successfully');
	        return redirect(route('myprofile'));
	        
		}
		catch (\Exception $e) {
		    return $e->getMessage();
		}
    }
    public function getoneuserprofile($id){
    	$user = User::findOrFail($id);


    	if(\Auth::user()->is_superuser || ($user->role_id == 2 || $user->role_id == 10) || (\Auth::user()->role_id == 1 && $user->club_id == \Auth::user()->club_id) )//if user is a player or a coach, anyone can see his/her profile.
    	{    		
            if($user->role_id==2)
            {
                if(count($user->sports))
                {
                    $i=0;
                    foreach($user->sports as $sport)
                    {
                        if($sport->pivot->coach_id!=Null)
                        {
                            $user->sports[$i]['coach'] = User::where('id',$sport->pivot->coach_id)->first();
                        }  
                        $array = array(
                                "club_id" =>    $user->club_id,
                                "sport_id"  =>  $sport->id
                            );
                        //\DB::connection()->enableQueryLog();     
                        $user->sports[$i]['club_fees'] =  Fee::where($array)->get();
                        //print_r(\DB::getQueryLog());
                        //exit;
                         $array = array(
                            "user_id"   =>  $user->id,
                            "sport_id"   =>  $sport->id,
                        );
                        $user->sports[$i]['membership'] = PlayerMembership::where($array)->first();
                        if($user->sports[$i]['membership'] != Null)
                        {
                            $user->sports[$i]['membership']['fees'] = Fee::find($user->sports[$i]['membership']->fee_id);
                        }                     
                        $i++;
                    }
                }
                $date = new \DateTime();
                $array1 = array(
                                'month' => $date->format('m'),
                                'year' => $date->format('Y'),
                            );

            
                $date->modify('+ 1 month');
                $array2 = array(
                                'month' => $date->format('m'),
                                'year' => $date->format('Y'),
                            );
               
                $date->modify('- 2 month'); 
                $array3 = array(
                                'month' => $date->format('m'),
                                'year' => $date->format('Y'),
                            );
                $user->payments = Payment::where($array1)
                                        ->orWhere($array2)
                                        ->orWhere($array3)
                                        ->get();
            }

            $array  = array('user'  =>  $user);
            return view('user.oneUser',$array);
    	}
        else{
        	$array 	= 	array(
        						"msg" => 'You are not authorized to view this page.'
        					);     
            return view('errors.error',$array);
        }
    	
    }

    

    public function addCoachFees(Request $request){
    	//echo $request->id;
    	$request->validate([
            'id'             				=> 'required',
            'session_rate'             		=> 'required|numeric|min:0',
        ]);	
    	$user = User::findOrFail($request->id);
    	if(\Auth::user()->id == $user->id || (\Auth::user()->club_id == $user->club_id && \Auth::user()->role_id == 1))
    	{
    		$coachFee = 	CoachFee::where('user_id', $user->id)->first();
    		if(!$coachFee)
    		{
    			$coachFee = new CoachFee;
    			$coachFee->user_id = $user->id;
    		}
    		$coachFee->session_rate = $request->session_rate;
    		$coachFee->save();
    		Session::flash('alert-success', 'Session Rate updated successfully');

    		if($user->id == \Auth::user()->id)
    		{
    			return redirect(route('myprofile'));
    		}
    		return redirect(route('getoneuserprofile',$user->id));

    	}
    	else{
    		
    		return redirect('/');
    	}
    }

    public function changeuserstatus($id)
    {
        $user = User::findOrFail($id);
        if(\Auth::user()->club_id == $user->club_id && \Auth::user()->role_id ==1)
        {
            $user->is_active = !$user->is_active;
            $user->save();
            Session::flash('alert-success', 'User status updated successfully');   
        }
        return redirect(route('getoneuserprofile',$id));
    }
    public function addcoachtoplayer($sport_id,$user_id){
        $array = array('id' =>  $user_id,"club_id" => \Auth::user()->club_id,"role_id"  => 2);
        $user = User::where($array)
                 ->whereHas("sports", function($q){
                           $q->where("sports.id",request()->segment(3));
                        })
                ->firstOrFail();

        $array = array('club_id'    => \Auth::user()->club_id, 'role_id' => 10, "is_active" => true);

        $coaches = User::where($array)
                        ->whereHas('sports', function($q){
                            $q->where('sports.id',request()->segment(3));
                        })
                        ->get();
        $sport  = Sport::findOrFail($sport_id);
        $array  = array('user_id' => $user_id,'sport_id' => $sport_id);
        $selected_coach = SportUserClub::where($array)->first();
        if($selected_coach)
        {
            $selected_coach_id = $selected_coach->coach_id;
        }
        else{
            $selected_coach_id = 0;
        }

        $array = array('coaches' => $coaches,'sport'    =>  $sport, "user" => $user,"selected_coach_id" => $selected_coach_id);
        return view('club.addcoachtoplayer',$array);
    }

    public function assigncoach(Request $request)
    {
        $request->validate([
            'sport_id' => 'required|numeric',
            'user_id'  => 'required|numeric',
        ]);
        if($request->coach_id == '')
            $request->coach_id = null;
        $array  = array('id' => $request->user_id, "role_id" => 2, 'club_id' => \Auth::user()->club_id);
        $user = User::where($array)->firstOrFail();
        $array  = array('user_id' => $request->user_id,'sport_id' => $request->sport_id);
        $sport = SportUserClub::where($array)->firstOrFail();
        $sport->coach_id = $request->coach_id;
        $sport->save();
        Session::flash('alert-success', 'Coach assigned successfully');

        return redirect(route('getoneuserprofile',$request->user_id));
    }

    public function storePlayerMembership(Request $request){
        $request->validate([
            'sport_ids' => 'required',
        ]);
        //echo "<prE>";
        //print_r($_REQUEST);
        $user = User::findOrFail($request->user_id);
        if(\Auth::user()->club_id == $user->club_id && (\Auth::user()->role_id == 10 || \Auth::user()->role_id==1)){
            if(count($request->sport_ids))
            {
                foreach($request->sport_ids as $sport_id)
                {
                    $array  = array(
                                        "user_id"    =>     $user->id,
                                        "sport_id"   =>     $sport_id
                                    );
                    $playerMembership   =   PlayerMembership::where($array)->first();
                    if($playerMembership == Null)
                    {
                        $playerMembership = new PlayerMembership;
                    }
                    $playerMembership->membership_type  =  $_REQUEST['member_type_'.$sport_id];
                    $playerMembership->fee_id =  $_REQUEST['fee_id_'.$sport_id];
                    $playerMembership->user_id =  $_REQUEST['user_id'];
                    $playerMembership->sport_id =  $sport_id;
                    $playerMembership->save();
                }
                Session::flash('alert-success', 'Membership Plan updated successfully');

            }
        }
        return redirect(route('getoneuserprofile',$request->user_id));

    }

    public function demo(){
        $array  = array('user'  =>  \Auth::user());
        //$pdf = PDF::loadView('pdf.invoice', $array);
        //return $pdf->download('invoice.pdf');
        //return $pdf->stream();

        $html = view('pdf.invoice')->render();

        return PDF2::load($html)->filename('invoice.pdf')->download();

        return view('pdf.invoice');
    }

    public function createUser($id){
        $club   =   Club::findOrFail($id);
        $array  =   array(
                            "club"  =>  $club,
                            "roles" =>  Role::all()
                        );
        return view('admin.createUser', $array);
    }

    
}
