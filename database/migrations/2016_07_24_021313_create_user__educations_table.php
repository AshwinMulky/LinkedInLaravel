<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('educations_id');
            $table->string('school-name');
            $table->string('field-of-study');
            $table->string('start-date');
            $table->string('end-date');
            $table->string('degree');
            $table->string('activities');
            $table->text('notes');
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
        Schema::drop('user__educations');
    }
}
