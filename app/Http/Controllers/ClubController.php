<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use App\Role;
use App\Sport;
use App\SportUserClub;
use App\ReleaseInvoice;
use App\Fee;
use Illuminate\Http\Request;
use Session;
use Mail;
use App\Mail\TestEmail;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CommonController;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = env('RESULT_LIMIT');
        $query = Club::with('users');
        if(!empty($_GET['search'])){
             $query->where('club_name', 'like', '%' . $_GET['search'] . '%');
        }
        $clubs = $query->orderBy('id', 'DESC')->paginate($limit);
        $array  =   array('clubs' =>     $clubs);
        return view('admin.showclubs',$array);
    }

    public function clubDetail($id){
        if(!CommonController::checkClubAdminOrSuperUser(\Auth::user()))
            abort(404);
        $club   =   Club::findOrFail($id);
        $array  =   array(
                            "club"  =>  $club
                        );
        return view('admin.clubDetails',$array);
    }
    public function loginAsUser($id){
        $user   =   User::findOrFail($id)->with(['users' => function($q){
            $q->orderby(['role_id']);
        }]);
        Session::put('admin_id', \Auth::user()->id);
        //echo Session::get('admin_id');
        \Auth::loginUsingId($id);
        $manager    =   new ManagerController;
        $route      =   $manager->findUserDashboard();
        return redirect()->route($route);

    }
    public function loginAsSuperadmin(){
        if(Session::has('admin_id'))
        {
            $id = Session::get('admin_id');
            $user   =   User::findOrFail($id);
            \Auth::loginUsingId($id);
            Session::forget('admin_id');
            return redirect()->route('adminDashboard');
        }
        return redirect()->route('index');
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

    public function fees($id = 0){
        if($id > 0 )
        {
            $club = Club::findOrFail($id);
            $sports     =   $club->sports;
            $club_id    =   $id;
        }
        else{
            $sports = \Auth::user()->club->sports;
            $club_id    =   \Auth::user()->club_id;
            $club =     \Auth::user()->club;
        }
        

        if(count($sports))
        {
            for($i=0;$i<count($sports);$i++)
            {
                $array = array(
                                "club_id" =>    $club_id,
                                "sport_id"  =>  $sports[$i]["id"],
                            );
                $sports[$i]['fees'] = Fee::where($array)->get();
            }
        }
        //$fees = \Auth::user()->club->sports;
        // if(!count($fees))
        // {
        //     return view('club.addfees');
        // }
        $array = compact('sports','club');
        return view('club.fees', $array);

        
    }
    public function storefees(Request $request, $club_id){
        $request->validate([
            'sport_id'         => 'required',
            'category'         => 'required',
            'monthly'         => 'required',
            'quarterly'         => 'required',
            'half_yearly'         => 'required',
            'yearly'         => 'required'
        ]);
        try{
            if(count($request->category))
            {
                for($i=0;$i<count($request->category);$i++)
                {
                    $fees = new Fee;
                    $fees->sport_id     =   $request->sport_id;
                    $fees->club_id      =   $club_id;
                    $fees->monthly      =   $request->monthly[$i];
                    $fees->quarterly      =   $request->quarterly[$i];
                    $fees->half_yearly      =   $request->half_yearly[$i];
                    $fees->yearly      =   $request->yearly[$i];
                    $fees->category_name      =   $request->category[$i];
                    //$fees->late_fine_day      =   $request->late_fees_day[$i];
                    //$fees->late_fine_amount      =   $request->late_fees[$i];
                    $fees->Save();
                }
            }
            if(\Auth::user()->is_superuser){
                return redirect(route('admin.fees', $club_id));
            }
            return redirect(route('club_fees'));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function payment_module(Request $request, $month, $year){
        $defaulter  =  $request->defaulter;
        $name  =   $request->name;
        $array  =   array(
                        'role_id' => 2,
                        'is_active' =>  1,
                        'club_id'   =>  \Auth::user()->club_id
                    );
        $query  =   User::where($array)->with([
                                'payments2' => function ($query) use($month, $year){
                                $array  = array(
                                                    "month"   =>  $month,
                                                    "year"   =>  $year,
                                                );
                                    $query->where($array)->where('total_amount', '>', 0);
                                },'recordpayments','payments',
                                'release_invoice' => function($query) use($month, $year){
                                    $array  = array(
                                                    "month"   =>  $month,
                                                    "year"   =>  $year,
                                                );
                                    $query->where($array);
                                }]);

        if(!empty($defaulter))
        {
            switch ($defaulter){
                case 'defaulter':
                    $query->where('is_defaulter', true);
                    break;
                case 'non-defaulter':
                    $query->where('is_defaulter', false);
                    break; 
            }
        }
        if(!empty($name))
        {
            $query->whereRaw('CONCAT(fname," ",lname) LIKE "%'.$name.'%"');
        }

        //echo $query->toSql(); exit;
        $users  =   $query->get();
       
        $release_invoice = true;
        // if(!ReleaseInvoice::where($array)->first() && count($users)){            
        //     foreach($users as $user)
        //     {
        //         if(!count($user->payments2))
        //         {
        //             $release_invoice = false;
        //             break;
        //         }
        //     }            
        // }     
        $array  =   array(
                            'users'   =>  $users,
                            'month'   =>  $month,
                            'year'   =>  $year,
                            'release_invoice'   =>  $release_invoice
                        );
        //echo date('Y-M-d',strtotime($year."/".$month."/1"));
        return view('club.payment_module', $array);
    }
    public function update_late_fees(Request $request, $id){
        if((\Auth::user()->is_superuser || \Auth::user()->club_id == $id ) && ($request->late_fees >= 0  && $request->late_fees <=100000)){
            $club   =   Club::findOrFail($id);
            $club->late_fees = $request->late_fees;
            $club->save();
            Session::flash('alert-success', 'Late fees updated successfully');
        }
        return back()->withInput();
    }

    public function editclub($club_id){
        if(\Auth::user()->is_superuser || ( \Auth::user()->role_id == 1 && \Auth::user()->club_id == $club_id ) ){
            $club   =   Club::findOrFail($club_id);
            $sports =   Sport::all();
            $array  =   array(
                                "club"  =>  $club
                            );
            return view('admin.editclub', $array);
        }
        else{
            Session::flash('alert-success', 'You are not authorized for this action');

            abort(404);
        }
    }
    public function updateclub(Request $request, $club_id){

        $request->validate([
            'club_name'         => 'required|max:255',
            'gst_no'            => 'required|unique:clubs,gst_no,'.$club_id,
            'contact_fname'     => 'required',
            'contact_lname'     => 'required',
            'payment_due_date'  => 'required|integer',
            'email'             => 'required|unique:clubs,email,'.$club_id,
            'mobile'            => 'required|unique:clubs,mobile,'.$club_id
        ]);
        $club   =   Club::findOrFail($club_id);
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
        $club->payment_due_date     = $request->payment_due_date;
        $club->save();
        Session::flash('alert-success', 'Organization updated successfully');
        if(\Auth::user()->is_superuser)
            return redirect(route('clubDetail', $club->id));
        return redirect(route('editclub', $club->id));
    }

    public function uploadLogo(Request $request, $club_id){
        if(!CommonController::checkClubAdminOrSuperUser(\Auth::user()))
            abort(404);
        $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $club = Club::findOrFail($club_id);
            if($club->logo!='')
            {
                @unlink(public_path('/images/'.$club->logo));
            }
            $image = $request->file('logo');
            $profile_pic = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $profile_pic);


            $club->logo = $profile_pic;
            $club->save();
            Session::flash('alert-success', 'Logo updated successfully');
            return redirect(route('clubDetail',$club_id));
            
        }
        catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
    
}

