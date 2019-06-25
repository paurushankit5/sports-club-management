<?php
namespace App\Http\Controllers;

use App\RecordPayment;
use App\Payment;
use App\User;
use App\Session as CoachSession;
use Session;
use Illuminate\Http\Request;
use App\ReleaseInvoice;

class RecordPaymentController extends Controller
{
    public function recordpayment($id)
    {
        $array = array(
                        "id"        =>  $id,
                        "role_id"   =>  2 
                    );
        if(!\Auth::user()->is_superuser){
            $array['club_id']   = \Auth::user()->club_id;
        }
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
    public function storerecordpayment(Request $request, $user_id){
        if(\Auth::user()->is_superuser ||  \Auth::user()->role_id == 1 || \Auth::user()->role_id == 10)
        {
            $user   =   User::findOrFail($user_id);

            if(isset($_REQUEST['late_fees']) && $_REQUEST['late_fees'] == 'true')
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
                $payment->user_id = $user_id;
                $payment->amount = $user->club->late_fees;
                $payment->discount = 0;
                $payment->total_amount = $user->club->late_fees;
                $payment->extra_fields = 'Late Fees';
                $payment->save();

            }
            $payment = new RecordPayment;
            $payment->user_id           =   $user_id;
            $payment->receiver_id       =   \Auth::user()->is_superuser ? null : \Auth::user()->id;  
            $payment->payment_received  =   $_REQUEST['payment_received'];
            $payment->payment_date      =   $_REQUEST['payment_date'];
            $payment->notes             =   $_REQUEST['notes'];
            $payment->save();
           // return $payment->id;
            \Session::flash('alert-success', 'Coach assigned successfully');

            return redirect(route('getoneuserprofile', $user->id));
        }
        else{
             return abort(404);
        }
        
    }

    public function showreceivedpayment($id)
    {
        if(\Auth::user()->role_id ==1 || \Auth::user()->role_id ==10 || \Auth::user()->is_superuser){
            $array = array(
                        "id"        =>  $id,
                        "role_id"   =>  2 
                    );
            if(!\Auth::user()->is_superuser){
                $array['club_id']   = \Auth::user()->club_id;
            }
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

    public function getMonthlyRevenue($month, $year)
    {
        $receivedPayments =     RecordPayment::with('user')
                                                ->whereMonth('payment_date', $month)
                                                ->whereYear('payment_date', $year)
                                                ->orderBy('payment_date')
                                                ->get();
        $array  = array('receivedPayments'  =>  $receivedPayments,
                        'month' =>  $month,
                        'year'  =>  $year
                        );
        return view('club.getMonthlyRevenue',$array);
    }
    
    public function revenueByCoach($month, $year)
    {
        //\DB::connection()->enableQueryLog();

        $sessions   =   CoachSession::select('coach_id', \DB::raw('SUM(final_amount) as total_amount'),  \DB::raw('SUM(session_count) as total_sessions'))
                                    ->with('users')
                                    ->whereHas("users", function($q){
                                           $q->where("users.club_id",\Auth::user()->club_id);
                                        })
                                    ->whereMonth('session_date' , $month)
                                    ->whereYear('session_date', $year)
                                    ->groupBy('coach_id')
                                    ->get();
        //print_r(\DB::getQueryLog());
        //exit;
        $array  = array('sessions'  =>  $sessions,
                        'month' =>  $month,
                        'year'  =>  $year
                        );
        return view('club.revenueByCoach',$array);

    }

    public function release_invoice(Request $request){
        if(count($request->user_ids))
        {
            try{
                \DB::beginTransaction();
                foreach($request->user_ids as $user_id){
                    $array      =       array(
                                        "month"     =>   $request->month,
                                        "year"      =>   $request->year,
                                        "user_id"   =>   $user_id
                                    );
                    $release_invoice    =   ReleaseInvoice::where($array)->get();
                    if(!count($release_invoice))
                    {
                        $release_invoice            =   new ReleaseInvoice;
                        $release_invoice->month     =   $request->month;
                        $release_invoice->year      =   $request->year;
                        $release_invoice->user_id   =   $user_id;
                        $release_invoice->save();
                    }
                }
                \DB::commit();
                $status = 1;
                $msg = 'Your request to release invoice has been successfully submitted.';
            }
            catch(Exception $e) {
                \DB::rollBack();
                $status = 0;
                $msg = $e->getMessage();
            }
        }
        $array  = array('status'    =>  $status,
                        'msg'       =>  $msg
                        );
        return $array;
    }
}

