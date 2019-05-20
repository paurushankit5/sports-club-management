<?php

namespace App\Http\Controllers;

use App\RecordPayment;
use App\Payment;
use App\User;
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
        $user->payment_received = RecordPayment::where('user_id',$id)->sum('payment_received');
        $user->invoice_generated = Payment::where('user_id',$id)->sum('total_amount');
        $array = array(
                        "user"  =>  $user
                    );
        

        return view('user.recordpayment',$array);
    }
    public function storerecordpayment($id){
        // echo "<pre>";
        // print_r($_REQUEST);
        $payment = new RecordPayment;
        $payment->user_id           =   $id;
        $payment->receiver_id       =   \Auth::user()->id;  
        $payment->payment_received  =   $_REQUEST['payment_received'];
        $payment->payment_date      =   $_REQUEST['payment_date'];
        $payment->notes             =   $_REQUEST['notes'];
        $payment->save();
        return redirect(route('showreceivedpayment',$id));
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
    
}
