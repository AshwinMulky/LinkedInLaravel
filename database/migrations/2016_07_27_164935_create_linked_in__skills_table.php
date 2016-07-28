<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__skills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->integer('skills_id');
            $table->string('skills_name');
            $table->integer('experience_year');
            $table->integer('experience_months');
            $table->string('experience_level');
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
        Schema::drop('linked_in__skills');
    }
}
