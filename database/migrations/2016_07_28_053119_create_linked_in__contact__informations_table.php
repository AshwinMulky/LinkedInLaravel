<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInContactInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__contact__informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->string('phone_number_mobile');
            $table->string('phone_number_home');
            $table->string('phone_number_work');
            $table->string('twitter_account_name1');
            $table->string('twitter_account_name2');
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
        Schema::drop('linked_in__contact__informations');
    }
}
