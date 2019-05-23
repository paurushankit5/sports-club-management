<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sport_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('coach_id')->unsigned()->nullable();
            $table->date('session_date')->nullable();
            $table->bigInteger('session_charge')->default(0);
            $table->bigInteger('session_count')->default(1);
            $table->bigInteger('final_amount')->default(0);
            $table->foreign('sport_id')->references('id')->on('sports');            
            $table->foreign('user_id')->references('id')->on('users');            
            $table->foreign('coach_id')->references('id')->on('users');            
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
