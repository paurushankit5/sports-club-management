<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ClubController;

class AdminController extends Controller
{
    public function getClubFees($id){
    	$obj 	= 	new ClubController;
    	$abc = $obj->fees($id);
    	return $abc;
    }
}
