<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__certifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('certifications_id');
            $table->string('name');
            $table->string('authority_name');
            $table->string('license_number');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::drop('linked_in__certifications');
    }
}
