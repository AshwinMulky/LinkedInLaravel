<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('sex');
            $table->string('nationality');
            $table->string('phone');
            $table->string('website');
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
        Schema::drop('linked_in__users');
    }
}
