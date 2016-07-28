<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__publications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkedin_id');
            $table->integer('publications_id');
            $table->text('title');
            $table->string('publisher_name');
            $table->integer('authors_id');
            $table->string('authors_name');
            $table->text('authors');
            $table->string('date');
            $table->string('url');
            $table->text('summary');
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
        Schema::drop('linked_in__publications');
    }
}
