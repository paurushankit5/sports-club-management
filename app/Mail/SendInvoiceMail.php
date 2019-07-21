<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class SendInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $month;
    public $year;
    public function __construct($array, $month, $year)
    {
        $this->data     =   $array;
        $this->month    =   $month;
        $this->year     =   $year;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Invoice for the month of ".date('M-Y',strtotime($this->month.'/1/'.$this->year));
        Log::info($subject);
        return $this->subject($subject)
                    ->view('pdf.invoice', $this->data);
    }
}
