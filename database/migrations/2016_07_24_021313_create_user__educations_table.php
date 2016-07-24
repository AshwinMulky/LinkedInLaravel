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
            $table->string('college_name');
            $table->string('university_name');
            $table->string('course');
            $table->integer('year_of_passing');

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
