<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PaymentController;
use App\ReleaseInvoice;
use App\User;
use App\Jobs\SendInvoiceJob;


class SendInvoiceScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send invoice to all players whose invoice needs to be released';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $relase_invoices = ReleaseInvoice::where("is_completed", 0)->get();
        if(count($relase_invoices))
        {
            foreach ($relase_invoices as $relase_invoice) {
               $obj     =   new PaymentController;
               $payments = $obj->getOneMonthInvoice($relase_invoice->user_id,$relase_invoice->month,$relase_invoice->year);

                $user = User::findOrFail($relase_invoice->user_id);
                $array    =     array(  
                                        "payments"  => $payments,
                                        "user"      => $user
                                    );
                dispatch(new SendInvoiceJob($array, $user->email,$relase_invoice->month,$relase_invoice->year))->delay(60 * .5); 
                $relase_invoice->is_completed = 1;
                $relase_invoice->save();
            }
        }

        
    }
}
