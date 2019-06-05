<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;



class EmailController extends Controller
{
    public function sendEmail()
    {
    	//echo "hello";
        //Mail::to('paurushankit5@gmail.com')->send(new SendMailable());
        //$emailJob = (new SendEmailJob())->delay(Carbon::now()->addSeconds(100));
   		SendEmailJob::dispatch(new SendEmailJob())->delay(now()->addMinutes(10));
        echo 'email sent';
    }
}
