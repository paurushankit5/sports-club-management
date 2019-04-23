<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use App\Role;
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
        $array  =   array('roles'   =>  $roles);
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

            $pwd                        =   'sport'.rand(11111111,99999999);
            $user                       =   new User;
            $user->fname                =   $request->fname;
            $user->lname                =   $request->lname;
            $user->email                =   $request->user_email;
            $user->alternate_email      =   $request->user_alternate_email;
            $user->mobile               =   $request->user_mobile;
            $user->alternate_mobile     =   $request->user_alternate_mobile;
            $user->is_active            =   true;
            $user->role_id              =   1;
            $user->password             =   \Hash::make($pwd);
            $user->save();

            $data = array('name'=> $user->fname." ".$user->lname, 'email' => $user->email, 'password'    => $pwd  );
            
            Mail::to($user->email)->send(new TestEmail($data));
            Session::flash('alert-primary', 'Organization added successfully');
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
}
