<?php

namespace App\Http\Controllers;

use App\RecordPayment;
use App\Payment;
use App\User;
use Session;
use Illuminate\Http\Request;

class RecordPaymentController extends Controller
{
    public function recordpayment($id)
    {
        $array = array(
                        "id"        =>  $id,
                        "club_id"   =>  \Auth::user()->club_id,
                        "role_id"   =>  2 

                    );
        $user = User::where($array)->firstOrFail();
        $user->payment_received = RecordPayment::where('user_id',$id)->orderBy('created_at', 'DESC')->sum('payment_received');
        $user->invoice_generated = Payment::where('user_id',$id)->sum('total_amount');

        $array = array(
                        "user"  =>  $user
                    );
        
        if($user->invoice_generated - $user->payment_received <= 0){
            Session::flash('alert-danger', 'You have no pending amount to recieve');
            return redirect(route('getoneuserprofile', $user->id));
        }   
        return view('user.recordpayment',$array);
    }
    public function storerecordpayment(Request $request){
        if( (\Auth::user()->role_id == 1 || \Auth::user()->role_id == 10))
        {
            if($_REQUEST['late_fees'])
            {
                $array      =   array(

                                );
                $payment    =   Payment::where($array)->first();
                if($payment){
                    $month = $payment->month;
                    $year = $payment->year;
                }
                else{
                    $month = date('m');
                    $year = date('Y');
                }
                $payment = new Payment;
                $payment->month = $month;
                $payment->year = $year;
                $payment->user_id = $_REQUEST['user_id'];
                $payment->amount = \Auth::user()->club->late_fees;
                $payment->discount = 0;
                $payment->total_amount = \Auth::user()->club->late_fees;
                $payment->extra_fields = 'Late Fees';
                $payment->save();

            }
            $payment = new RecordPayment;
            $payment->user_id           =   $_REQUEST['user_id'];
            $payment->receiver_id       =   \Auth::user()->id;  
            $payment->payment_received  =   $_REQUEST['payment_received'];
            $payment->payment_date      =   $_REQUEST['payment_date'];
            $payment->notes             =   $_REQUEST['notes'];
            $payment->save();
            return $payment->id;
        }
        else{
            return ('You are noy authorized to perform this task');
        }
        
    }

    public function showreceivedpayment($id)
    {
        if(\Auth::user()->role_id ==1){
            $array = array(
                        "id"        =>  $id,
                        "club_id"   =>  \Auth::user()->club_id,
                        "role_id"   =>  2 
                    );
            $user = User::where($array)->with('recordpayments')->firstOrFail();

            $array = array('user'   =>  $user);

            return view('user.showreceivedpayment',$array);

        }
    }

    public function getpaymentdetails(Request $request)
    {
        $array = array(
                        "id"        =>  $request->user_id,
                        "club_id"   =>  \Auth::user()->club_id,
                        "role_id"   =>  2 
                    );
        $user = User::where($array)->firstOrFail();
        $user->payment_received = RecordPayment::where('user_id',$request->user_id)->orderBy('created_at', 'DESC')->sum('payment_received');
        $user->invoice_generated = Payment::where('user_id',$request->user_id)->sum('total_amount');
        $late_fees = \Auth::user()->club->late_fees;
        $array  = array(
                        "user"  =>  $user,
                        "late_fees" =>  $late_fees
                    );
        return $array;
    }
    
}
