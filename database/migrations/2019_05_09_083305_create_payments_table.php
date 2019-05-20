<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('month');
            $table->integer('year');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('sport_id')->unsigned()->nullable();
            $table->integer('amount');
            $table->integer('late_fees')->default(0);
            $table->integer('discount')->default(0);
            $table->string('notes')->nullable();
            $table->integer('total_amount');
            $table->string('extra_fields')->nullable();
            $table->boolean('is_session_charge')->default(false);
            $table->foreign('sport_id')->references('id')->on('sports');
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
        Schema::dropIfExists('payments');
    }
}
