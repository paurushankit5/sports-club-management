<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function findRoutes($user){
    	if($user->is_superuser)
        {
            return 'adminDashboard';
        }
        else if($user->role_id == 1 ){
            return 'clubDashboard';
        }
        else if($user->role_id == 10 ){
            return 'coachDashboard';
        }
        return 'index';
    }
}
