<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('club_name');
            $table->string('contact_fname');
            $table->string('contact_lname');
            $table->string('email');
            $table->string('alternate_email');
            $table->string('mobile');
            $table->string('alternate_mobile');
            $table->string('adl1');
            $table->string('adl2');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pin');
            $table->string('establishment_year');
            $table->string('about_club');
            $table->string('gst_no');
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
        Schema::dropIfExists('clubs');
    }
}
