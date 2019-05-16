<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use App\Fee;
use App\CoachFee;
use App\PlayerMembership;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment($user_id,$month,$year){
        $array = array(
                        "id"         =>  $user_id,
                        "role_id"    =>  2,
                    );
        $user =  User::where($array)->firstOrFail();
        if(count($user->sports))
        {
            $i=0;
            foreach($user->sports as $sport)
            {
                if($sport->pivot->coach_id!=Null)
                {
                    $user->sports[$i]['coach'] = User::where('id',$sport->pivot->coach_id)->first();
                    if($user->sports[$i]['coach'])
                    {
                        $array = array(
                                            "user_id" => $sport->pivot->coach_id,
                                        );
                        $user->sports[$i]['coach']['fee'] = CoachFee::where($array)->first(); 
                    }
                    $array = array(
                        "club_id" =>    $user->club_id,
                        "sport_id"  =>  $sport->id
                    );
                }
                $user->sports[$i]['club_fees'] =  Fee::where($array)->get();
                 $array = array(
                    "user_id"   =>  $user->id,
                    "sport_id"   =>  $sport->id,
                );
                $user->sports[$i]['membership'] = PlayerMembership::where($array)->first();
                if($user->sports[$i]['membership'] != Null)
                {
                    $user->sports[$i]['membership']['fees'] = Fee::find($user->sports[$i]['membership']->fee_id);
                }
                                      
                $i++;
            }
        }
        $array = array('user'   => $user,
                        'month' => $month,
                        'year' => $year,
                        );
        return view ('user.payment',$array);
    }
    public function storepayment(Request $request){
        try{
            //echo "<prE>";
            //print_r($_REQUEST);
            $id=  request()->segment(3);
            $month=  request()->segment(4);
            $year=  request()->segment(5);
            $user = User::findOrFail($id);
            if(count($user->sports))
            {
                $i=0;
                foreach($user->sports as $sport)
                {
                    if($sport->pivot->coach_id!=Null)
                    {
                        $coach = User::where('id',$sport->pivot->coach_id)->first();
                        if($coach)
                        {
                            $array = array(
                                                "user_id" => $sport->pivot->coach_id,
                                            );
                            $coach['fee'] = CoachFee::where($array)->first(); 
                            if($coach['fee']['session_rate'] != Null && isset($_REQUEST['session_count_'.$sport->id]))
                            {
                                $payment = new Payment;
                                $payment->month = $month;
                                $payment->year = $year;
                                $payment->user_id = $id;
                                $payment->sport_id = $sport->id;
                                $payment->coach_id = $coach->id;
                                $payment->amount = $request['session_count_'.$sport->id] * $coach['fee']['session_rate'];
                                $payment->discount = $request['discount_coach_session_'.$sport->id];
                                $payment->total_amount = $payment->amount - $payment->discount;
                                $payment->session_count = $request['session_count_'.$sport->id];                    
                                $payment->per_session_charge = $coach['fee']['session_rate']; 
                                $payment->save();                   
                            }
                        }
                    }
                    $array = array(
                        "club_id" =>    $user->club_id,
                        "sport_id"  =>  $sport->id
                    );
                    $user->sports[$i]['club_fees'] =  Fee::where($array)->get();
                     $array = array(
                        "user_id"   =>  $user->id,
                        "sport_id"   =>  $sport->id,
                    );
                    $user->sports[$i]['membership'] = PlayerMembership::where($array)->first();
                    if($user->sports[$i]['membership'] != Null)
                    {
                        $user->sports[$i]['membership']['fees'] = Fee::find($user->sports[$i]['membership']->fee_id);
                        
                        $membership_fees = $user->sports[$i]['membership']['fees'][$user->sports[$i]['membership']['membership_type']];
                        $membership_duration = $user->sports[$i]['membership']['membership_type'];
                        //echo $membership_fees."<br>";
                        //echo $membership_duration."<br>";
                        if($membership_duration == 'monthly')
                        {
                            $start = $month;
                            $end = $month;
                        }
                        else if($membership_duration == 'quarterly'){
                            if($month<=3)
                            {
                                $start = 1;
                                $end = 3;
                            }
                            else if($month<=6)
                            {
                                $start = 4;
                                $end = 6;
                            }
                            else if($month<=9)
                            {
                                $start = 7;
                                $end = 9;
                            }
                            else if($month<=12){
                                $start = 10;
                                $end = 12;
                            }
                        }
                        else if($membership_duration == 'half_yearly'){
                            if($month<=6){
                                $start = 1;
                                $end = 6;
                            }
                            else if($month<=12){
                                $start = 7;
                                $end = 12;
                            }                        
                        }
                        else if($membership_duration == 'yearly'){
                            $start = 1;
                            $end = 12;                                               
                        }
                        $k=0;
                        for($j=$start;$j<=$end;$j++){
                            if($k!=0)
                            {
                                $membership_fees =   0;
                                $request['membership_discount_'.$sport->id] = 0;
                            }
                            $payment = new Payment;
                            $payment->month = $j;
                            $payment->year = $year;
                            $payment->user_id = $id;
                            $payment->sport_id = $sport->id;
                            $payment->amount = $membership_fees;
                            $payment->discount = $request['membership_discount_'.$sport->id];
                            $payment->total_amount = $payment['amount'] - $payment['discount'];
                            $payment->save();
                            $k++;
                        }
                    }                                 
                    $i++;
                }
            }
            if(count($request->category))
            {
                for($i=0;$i<count($request->category);$i++)
                {
                    if($request->category[$i] != '' && $request['extra_fees'][$i]!='')
                    {
                        $payment = new Payment;
                        $payment->month = $month;
                        $payment->year = $year;
                        $payment->user_id = $id;
                        $payment->amount = $request['extra_fees'][$i];
                        $payment->discount = $request['extra_discount'][$i];
                        $payment->total_amount = $request['extra_fees'][$i] - $request['extra_discount'][$i];
                        $payment->extra_fields = $request['category'][$i];
                        $payment->save();
                        //echo "save<br>";
                    }
                }
            }
            return redirect(route('showpayment', array($id,$month,$year)));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function showpayment($user_id,$month,$year){
        $array = array(
                        "month" => $month,
                        "year"  => $year,
                        "user_id" => $user_id,
                    );
        $payments = Payment::where($array)->with(array('sport','coach'))->get();
        $array    =     array(  
                                "payments"  => $payments
                            );
        return view('user.showpayment',$array);
    }
}
