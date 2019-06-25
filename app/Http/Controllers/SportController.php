<?php

namespace App\Http\Controllers;

use Session;
use App\Sport;
use App\User;
use App\SportUserClub;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function removeSportUserAssociation(Request $request, $user_id){
        $this->middleware('checkAdmin');
        $array      =   array(
                                "user_id"   =>  $user_id,
                                "sport_id"  =>  $request->sport_id
                            );
        $sport_user_club = SportUserClub::where($array)->firstOrFail();
        $sport_user_club->delete();
        return "success";
    }

    public function getUnAssociatedSports($user_id){
        $user =   User::with('club')->findOrFail($user_id);
        if($user->club && $user->club->sports && count($user->club->sports))
        {
            $data = array_diff_key( $user->club->sports->keyBy('id')->toArray(), $user->sports->keyBy('id')->toArray() );
            $array['status'] = 0;
            if(count($data))
            {
                $array['status'] = 1;

            }
            $array  =   array(
                                'data'  =>  $data
                            );
            return $array;
        }
        

        return ['status'    =>  0];
    }

    public function storeUnAssociatedSports(Request $request, $user_id){
        $user   =   User::findOrFail($user_id);
        if(\Auth::check() && (\Auth::user()->is_superuser || \Auth::user()->club_id == $user->club_id ) )
        {
            if(count($request->add_sports_ids))
            {
                foreach ($request->add_sports_ids as $sport_id) {
                    $array  = array(
                                        "user_id"   =>  $user_id,
                                        "sport_id"  =>  $request->sport_id
                                    );
                    if(!count(SportUserClub::where($array)->get()))
                    {
                        $sport_user     =   new SportUserClub;
                        $sport_user->user_id    =   $user_id;
                        $sport_user->sport_id   =   $sport_id;
                        $sport_user->save();
                    }
                }
                Session::flash('alert-success', 'Sport associated successfully');
            }
        }
        return redirect(route('getoneuserprofile', $user_id));
    }
}
