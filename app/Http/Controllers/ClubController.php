<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use App\Role;
use App\Sport;
use App\SportUserClub;
use App\Fee;
use Illuminate\Http\Request;
use Session;
use Mail;
use App\Mail\TestEmail;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::paginate(env('RESULT_LIMIT'));
        $array  =   array('clubs' =>     $clubs);
        return view('admin.showclubs',$array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles  = Role::where('is_global',1)->orderBy('role_name')->get();
        $sports  = Sport::orderBy('sport_name')->get();
        $array  =   array('roles'   =>  $roles,
                        "sports"    =>  $sports
                        );
        return view('admin.createClub',$array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'club_name'         => 'required|max:255',
            'gst_no'            => 'required|unique:clubs',
            'contact_fname'     => 'required',
            'contact_lname'     => 'required',
            'email'             => 'required|unique:clubs',
            'mobile'            => 'required|unique:clubs',
            'fname'             => 'required',
            'lname'             => 'required',
            'user_email'        => 'required|unique:users,email',
            'user_mobile'       => 'required|unique:users,mobile',
            'sports'            => 'required',

        ]);
        //\DB::transaction(function () {
        try{
            $club                       = new Club;
            $club->club_name            = $request->club_name;
            $club->gst_no               = $request->gst_no;
            $club->establishment_year   = $request->establishment_year;
            $club->about_club           = $request->about_club;
            $club->contact_fname        = $request->contact_fname;
            $club->contact_lname        = $request->contact_lname;
            $club->email                = $request->email;
            $club->alternate_email      = $request->alternate_email;
            $club->mobile               = $request->mobile;
            $club->alternate_mobile     = $request->alternate_mobile;
            $club->adl1                 = $request->adl1;
            $club->adl2                 = $request->adl2;
            $club->city                 = $request->city;
            $club->state                = $request->state;
            $club->country              = $request->country;
            $club->pin                  = $request->pin;
            $club->save();

            if(count($request->sports))
            {
                foreach ($request->sports as $sport) {
                    $club_sport               = new SportUserClub;
                    $club_sport->sport_id     = $sport;
                    $club_sport->club_id      = $club->id;
                    $club_sport->save();
                }
            }

            $pwd                        =   'sport'.rand(11111111,99999999);
            $user                       =   new User;
            $user->fname                =   $request->fname;
            $user->lname                =   $request->lname;
            $user->email                =   $request->user_email;
            $user->alternate_email      =   $request->user_alternate_email;
            $user->mobile               =   $request->user_mobile;
            $user->alternate_mobile     =   $request->user_alternate_mobile;
            $user->is_active            =   true;
            $user->club_id              =   $club->id;
            $user->role_id              =   1;
            $user->password             =   \Hash::make($pwd);
            $user->save();

           
            
            $data = array('name'=> $user->fname." ".$user->lname, 'email' => $user->email  );
            
            Mail::to($user->email)->send(new TestEmail($data));
            Session::flash('alert-success', 'Organization added successfully');
            return redirect(route('clubs.index'));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
    }

    public function sendmail(){
        $data = array('name'=> "abc def ", 'email' => 'login@gmail.com', 'password'    => "passwordhere"  );

        echo Mail::to('paurushankit5@gmail.com')->send(new TestEmail($data));
                    
    }

    public function fees(){
        $sports = \Auth::user()->club->sports;

        if(count($sports))
        {
            for($i=0;$i<count($sports);$i++)
            {
                $array = array(
                                "club_id" =>    \Auth::user()->club_id,
                                "sport_id"  =>  $sports[$i]["id"]
                            );
                $sports[$i]['fees'] = Fee::where($array)->get();
            }
        }
        //$fees = \Auth::user()->club->sports;
        // if(!count($fees))
        // {
        //     return view('club.addfees');
        // }
        $array = compact('sports');
        return view('club.fees', $array);

        
    }
    public function storefees(Request $request){
        $request->validate([
            'sport_id'         => 'required',
            'category'         => 'required',
            'monthly'         => 'required',
            'quarterly'         => 'required',
            'half_yearly'         => 'required',
            'yearly'         => 'required'


        ]);
        //echo "<pre>";
        try{
            if(count($request->category))
            {
                for($i=0;$i<count($request->category);$i++)
                {
                    $fees = new Fee;
                    $fees->sport_id     =   $request->sport_id;
                    $fees->club_id      =   \Auth::user()->club_id;
                    $fees->monthly      =   $request->monthly[$i];
                    $fees->quarterly      =   $request->quarterly[$i];
                    $fees->half_yearly      =   $request->half_yearly[$i];
                    $fees->yearly      =   $request->yearly[$i];
                    $fees->category_name      =   $request->category[$i];
                    $fees->late_fine_day      =   $request->late_fees_day[$i];
                    $fees->late_fine_amount      =   $request->late_fees[$i];
                    $fees->Save();
                }
            }
        return redirect(route('club_fees'));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function payment_module($month, $year){
        $array  =   array(
                        'role_id' => 2,
                        'is_active' =>  1,
                        'club_id'   =>  \Auth::user()->club_id
                    );
        $users  =   User::where($array)->with([
                                    'payments2' => function ($query) use($month, $year){
                                $array  = array(
                                                    "month"   =>  $month,
                                                    "year"   =>  $year,
                                                );
                                    $query->where($array);
                                },'recordpayments','payments'])->get();
        
        $array  =   array(
                            'users'   =>  $users,
                            'month'   =>  $month,
                            'year'   =>  $year
                        );
        return view('club.payment_module', $array);
    }
}
