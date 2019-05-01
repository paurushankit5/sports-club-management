<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportUserClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_user_club', function (Blueprint $table) {
            $table->bigIncrements('id');


            
            $table->bigInteger('sport_id')->unsigned();
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('user_id')->references('id')->on('users');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_user_club');
    }
}
