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
            $table->string('linkedin_id');
            /*$table->foreign('linkedin_id')->references('linkedin_id')->on('users');*/
            $table->string('first_name');
            $table->string('last_name');
            $table->string('maiden_name');
            $table->string('formatted_name');
            $table->string('phonetic_first_name');
            $table->string('phonetic_last_name');
            $table->string('formatted_phonetic_name');
            $table->text('headline');
            $table->string('industry');
            $table->string('current_share');
            $table->string('num_connections');
            $table->string('num_connections_capped');
            $table->string('specialties');
            $table->string('picture_url');
            $table->string('picture_urls_original');
            $table->string('site_standard_profile_request');
            $table->string('api_standard_profile_request');
            $table->string('public_profile_url');
            $table->string('last_modified_timestamp');
            $table->text('proposal_comments');
            $table->text('associations');
            $table->text('interests');
            $table->integer('num_recommenders');
            $table->text('following');
            $table->text('job_bookmarks');
            $table->text('suggestions');
            $table->string('date_of_birth');
            $table->string('member_url_resources');
            $table->string('related_profile_views');
            $table->string('honors_awards');
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
