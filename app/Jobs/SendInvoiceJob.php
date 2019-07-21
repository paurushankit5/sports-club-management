<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceMail;

class SendInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $data;
    private $month;
    private $year;
    private $email;
    public function __construct($data, $email_to, $month, $year)
    {
        $this->data     =   $data;
        $this->month    =   $month;
        $this->year     =   $year;
        $this->email    =   $email_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (env('APP_ENV') == 'development') {
            Mail::to("paurushankit5@gmail.com")->send(new SendInvoiceMail($this->data, $this->month, $this->year));
        }
        else{
            Mail::to($this->email)->send(new SendInvoiceMail($this->data));
        }
    }
}
