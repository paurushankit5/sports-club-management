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
    private $email;
    public function __construct($data, $email_to)
    {
        $this->data     =   $data;
        $this->email    =   $email_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //echo "<pre>";
        //print_r($this->data);
        //print_r($this->email);
        Mail::to($this->email)->send(new SendInvoiceMail($this->data));
    }
}
