<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('skill_name');
            $table->integer('experience_year');
            $table->integer('experience_months');
            $table->string('experience_level');//expert,intermediate
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
        Schema::drop('user__skills');
    }
}
