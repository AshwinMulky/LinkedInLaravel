<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->integer('company_id');
            $table->string('company_name');
            $table->string('company_type');
            $table->string('industry');
            $table->string('ticker');
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
        Schema::drop('linked_in__companies');
    }
}
