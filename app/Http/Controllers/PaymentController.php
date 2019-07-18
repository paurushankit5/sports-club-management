<?php

namespace App\Http\Controllers;
use App\Payment;
use App\User;
use App\Fee;
use App\CoachFee;
use App\PlayerMembership;
use Illuminate\Http\Request;
use Session;
use PDF;
use App\Mail\SendInvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendInvoiceJob;
use Carbon\Carbon;
use App\Http\Controllers\CommonController;



class PaymentController extends Controller
{
    public function payment($user_id,$month,$year){
        $array = array(
                        "id"         =>  $user_id,
                        "role_id"    =>  2,
                    );
        $user =  User::where($array)->with('sports')->firstOrFail();
        if(count($user->sports))
        {
            $i=0;
            foreach($user->sports as $sport)
            {
                //check if the invoice has been generated for this month
                $array  =   array(
                                    "month" =>  $month,
                                    "year"  =>  $year,
                                    "user_id"   =>  $user_id,
                                    "sport_id"  =>  $sport->id
                                );
                $user->sports[$i]->invoice_generated = Payment::where($array)->count() ? 1 : 0;
                //exit;


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
                }
                else{
                    Session::flash('alert-danger', 'Please set the membership plan first.');
                    return redirect(route('getoneuserprofile', $user->id));
                }
                                      
                $i++;
            }
        }
        $array  =   array(
                            "user_id"   =>      $user->id,
                            "month"   =>      $month,
                            "year"   =>      $year,
                        );
        $invoice_generated   =   count(Payment::where($array)->where('total_amount', '>', 0)->get()) ? true : false ;

        $array = array('user'   => $user,
                        'month' => $month,
                        'year' => $year,
                        'invoice_generated' => $invoice_generated,
                        );
        return view ('user.payment',$array);
    }
    public function storepayment(Request $request){
        try{
            // echo "<prE>";
            // print_r($_REQUEST);
            // exit;
            $id=  request()->segment(3);
            $month=  request()->segment(4);
            $year=  request()->segment(5);
            $user = User::findOrFail($id);
            if(count($user->sports))
            {
                $i=0;
                //echo "<pre>";
                //print_r($_REQUEST);
                foreach($user->sports as $sport)
                {
                    //print_r($sport);

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
                    if($user->sports[$i]['membership'] != Null && isset($_REQUEST['membership_discount_'.$sport->id]))
                    {
                        $user->sports[$i]['membership']['fees'] = Fee::find($user->sports[$i]['membership']->fee_id);
                        $membership_fees = $user->sports[$i]['membership']['fees'][$user->sports[$i]['membership']['membership_type']];
                        $membership_duration = $user->sports[$i]['membership']['membership_type'];
                        // echo $membership_fees."<br>";
                        // echo $membership_duration."<br>";
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
                            if($month != $j)
                            {
                                $m_fees =   0;
                                $discount_amount = 0;
                            }
                            else{
                                $m_fees = $membership_fees;
                                $discount_amount = $request['membership_discount_'.$sport->id];

                            }
                           // echo $m_fees."<br><br>";
                            $payment = new Payment;
                            $payment->month = $j;
                            $payment->year = $year;
                            $payment->user_id = $id;
                            $payment->sport_id = $sport->id;
                            $payment->amount = $m_fees;
                            $payment->discount = isset($discount_amount) ? $discount_amount : 0;
                            $payment->notes = $request['membership_note_'.$sport->id];
                            $payment->total_amount = $payment['amount'] - $payment['discount'];
                            $payment->payment_mode = $membership_duration;
                            $payment->save();
                            $k++;

                        }
                    }                                 
                    $i++;
                }
                //exit;
            }
            //exit;
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
            if(isset($request->session_charges) && $request->session_charges != '' && $request->session_charges > 0)
            {
                $payment = new Payment;
                $payment->month = $month;
                $payment->year = $year;
                $payment->user_id = $id;
                $payment->amount = $request['session_charges'];
                $payment->total_amount = $request['session_charges'];
                $payment->is_session_charge = true;
                $payment->save();   

                $user = User::findOrFail($id);
                $user->advance_amount += $request->session_charges;
                $user->save();
            }
            return redirect(route('showpayment', array($id,$month,$year)));
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function showpayment($user_id,$month,$year){
        $payments = $this->getOneMonthInvoice($user_id,$month,$year);
        $user = User::findOrFail($user_id);
        $array    =     array(  
                                "payments"  => $payments,
                                "user"      => $user
                            );
        return view('user.showpayment',$array);
    }
    public function getinvoices($id)
    {
        //\DB::connection()->enableQueryLog();
        $invoices = Payment::distinct()
                            ->where('user_id',$id)
                            ->where('amount' , '>' , 0)
                            ->orderBy('year','DESC')->orderBy('month','DESC')->get(['month','year']);
        return $invoices;
    }

    public function downloadInvoice($user_id, $month, $year){
        $payments = $this->getOneMonthInvoice($user_id,$month,$year);
        $user = User::findOrFail($user_id);
        $array    =     array(  
                                "payments"  => $payments,
                                "user"      => $user
                            );
         return view('pdf.invoice', $array);
        // $pdf = PDF::loadView('pdf.invoice', $array);
        // return $pdf->stream();
        //return $pdf->download('invoice.pdf');
        //return view('pdf.invoice',$array);
        //$html = view('pdf.invoice',$array)->render();

        //return PDF2::load($html)->filename('invoice.pdf')->download();

    }

    public function getOneMonthInvoice($user_id,$month,$year){
        $array = array(
                        "month" => $month,
                        "year"  => $year,
                        "user_id" => $user_id,
                    );
        return Payment::where($array)->with(array('sport','coach'))->get();
    }
    public function mail(){
        $payments = $this->getOneMonthInvoice(25,6,2019);

        $user = User::findOrFail(25);
        $array    =     array(  
                                "payments"  => $payments,
                                "user"      => $user
                            );
        //return view('pdf.invoice', $array);
        //dispatch(new SendInvoiceJob($array, "paurushankit5@gmail.com"))->delay(60 * .5);
        //Mail::to('paurushankit5@gmail.com')
        //->send(new SendInvoiceMail($array));

        Mail::to("paurushankit5@gmail.com")->send(new SendInvoiceMail($array));
        
        echo 'email sent';
    }

    public function playerInvoices($id){
        $user   =   User::findOrFail($id);
        if(CommonController::checkSuperUserOrClubOrCoachOrPlayer($user)){
            
            $invoices   =   Payment::select('month','year',\DB::raw('SUM(total_amount) as total_amount'))->where("user_id", $id)->groupBy('month','year')->orderByRaw('created_at DESC')->get();
            $array      =   array(
                                "invoices"  =>  $invoices,
                                "user"      =>  $user
                            );
            return view('player.playerInvoices', $array);
        }
        else{
            abort(404);
        }
    }

}
