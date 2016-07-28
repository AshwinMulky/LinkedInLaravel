<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->integer('languages_id');
            $table->string('language_name');
            $table->string('proficiency_level');
            $table->string('proficiency_name');
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
        Schema::drop('linked_in__languages');
    }
}
