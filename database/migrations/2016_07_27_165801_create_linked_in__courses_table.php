<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('courses_id');
            $table->string('courses_name');
            $table->string('courses_number');
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
        Schema::drop('linked_in__courses');
    }
}
