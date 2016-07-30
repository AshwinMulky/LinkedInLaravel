<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('positions_id');
            $table->string('positions_type');//past or current
            $table->string('title');
            $table->text('summary');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('is_current');
            $table->string('company');
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
        Schema::drop('linked_in__positions');
    }
}
