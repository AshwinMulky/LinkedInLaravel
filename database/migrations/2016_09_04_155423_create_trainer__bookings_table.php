<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainerBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainer__bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trainer_id');
            $table->date('booking_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('subject');
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
        Schema::drop('trainer__bookings');
    }
}
