<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('educations_id');
            $table->string('school_name');
            $table->string('field_of_study');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::drop('linked_in__educations');
    }
}
