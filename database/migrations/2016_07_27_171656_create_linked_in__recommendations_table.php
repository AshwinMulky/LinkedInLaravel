<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__recommendations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('linkedin_id');
            $table->integer('recommendations_id');
            $table->string('recommendation_type');
            $table->text('recommendation_text');
            $table->string('recommender');
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
        Schema::drop('linked_in__recommendations');
    }
}
