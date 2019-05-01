<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Idproof;

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
    	if(($user->role_id == 2 || $user->role_id == 10) || (\Auth::user()->role_id == 1 && $user->club_id == \Auth::user()->club_id) )//if user is a player or a coach, anyone can see his/her profile.
    	{
    		$array 	= array('user'	=> 	$user);
    		return view('user.oneUser',$array);
    	}
    	$array 	= 	array(
    						"msg" => 'You are not authorized to view this page.'
    					);
    		return view('errors.error',$array);
    	
    }
}
