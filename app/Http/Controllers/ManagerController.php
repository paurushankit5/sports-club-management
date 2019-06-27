<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function findUserDashboard(){
    	if(\Auth::check()){
    		if(\Auth::user()->is_superuser)
	        {
	            return 'adminDashboard';
	        }
	        else if(\Auth::user()->role_id == 1 ){
	            return 'clubDashboard';
	        }
	        else if(\Auth::user()->role_id == 10 ){
	            return 'coachDashboard';
	        }
	        else if(\Auth::user()->role_id == 2 ){
	            return 'playerDashboard';
	        }
    	}	    	
        return 'index';
    }
}