<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('club_id')->unsigned()->nullable();
            $table->integer('monthly')->nullable();
            $table->integer('quarterly')->nullable();
            $table->integer('half_yearly')->nullable();
            $table->integer('yearly')->nullable();
            $table->string('category_name');
            $table->string('late_fine_day')->nullable();
            $table->string('late_fine_amount')->nullable();
            $table->foreign('club_id')->references('id')->on('clubs');
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
        Schema::dropIfExists('fees');
    }
}
