<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ClubController;
use App\Sport;

class AdminController extends Controller
{
    public function getClubFees($id){
    	$obj 	= 	new ClubController;
    	$abc = $obj->fees($id);
    	return $abc;
    }

    public function sports(){
    	$sports 	= 	Sport::all();
    	$array 		= 	array('sports'	=> 	$sports);
    	return view('admin/sports', $array);
    }
}
