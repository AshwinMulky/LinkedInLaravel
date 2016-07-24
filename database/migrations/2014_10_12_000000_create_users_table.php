<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('sex');
            $table->string('nationality');
            /*$table->string('education');
            $table->string('company_name');
            $table->string('company_position');*/
            $table->string('phone');
            $table->string('website');
            /*$table->timestamp('registration_date');*/
            $table->string('avatar_url');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}