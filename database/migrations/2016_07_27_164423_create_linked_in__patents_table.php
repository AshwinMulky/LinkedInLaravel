<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInPatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__patents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('patents_id');
            $table->string('title');
            $table->text('summary');
            $table->string('number');
            $table->integer('status_id');   
            $table->string('status_name');
            $table->string('office_name');
            $table->integer('inventors_id');
            $table->string('inventors_name');
            $table->text('inventors');
            $table->string('date');
            $table->string('url');
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
        Schema::drop('linked_in__patents');
    }
}
