<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Club;
use App\User;
use App\Http\Controllers\PaymentController;
use Log;

class SetDefaulters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:defaulters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Log::info("set defaulter cron initiated at ".date('Y-m-d H:i:s'));
        $clubs  =   Club::all();
        if(count($clubs)){
            foreach($clubs as $club){

                $payment_due_date = date('Y-m-'.$club->payment_due_date);
                $today  = date('Y-m-d');
                $next_day   = date('Y-m-d', (strtotime($payment_due_date)+ 86400) );
                if($next_day == $today){
                    $array      =   array(
                                            "club_id"   =>  $club->id,
                                            "role_id"   =>  2,
                                        );
                    $players    =   User::where($array)->get();
                    if(count($players)){
                        foreach($players as $player){
                            $isDefaulter       =   PaymentController::isDefaulter($player);
                            Log::info($player->getFullName()." status is ".$isDefaulter );
                            if($isDefaulter){
                                $player->is_defaulter = true;
                                $player->save();
                            }
                        }
                    }
                    Log::info("defaulter cron initiated for club_id ".$club->id);
                }
            }
        }
    }
}
