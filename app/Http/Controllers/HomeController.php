<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ManagerController;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.pages.home');
    } 

    public function aboutUs()
    {
        return view('front.pages.about');
    }
     public function contactUs()
    {
        return view('front.pages.contact');
    }


    public function dashboard(){
        if(\Auth::check()){
            $manager    =   new ManagerController;
            $route      =   $manager->findUserDashboard();
            return redirect(route($route));
        }
        return $this->index();
    }
}
