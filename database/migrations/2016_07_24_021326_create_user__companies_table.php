<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('linkedin_id');
            $table->string('company_name');
            $table->string('company_type');
            $table->string('designation');
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
        Schema::drop('user__companies');
    }
}
