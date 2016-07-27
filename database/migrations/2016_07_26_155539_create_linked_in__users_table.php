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
            $table->string('first-name');
            $table->string('last-name');
            $table->string('maiden-name');
            $table->string('formatted-name');
            $table->string('phonetic-first-name');
            $table->string('phonetic-last-name');
            $table->string('formatted-phonetic-name');
            $table->text('headline');
            $table->string('industry');
            $table->string('current-share');
            $table->string('num-connections');
            $table->string('num-connections-capped');
            $table->string('specialties');
            $table->string('picture-url');
            $table->string('picture-urls::(original)');
            $table->string('site-standard-profile-request');
            $table->string('api-standard-profile-request');
            $table->string('public-profile-url');
            $table->string('email-address');
            $table->timestamp('last-modified-timestamp');
            $table->text('proposal-comments');
            $table->text('associations');
            $table->text('interests');
            $table->integer('num-recommenders');
            $table->text('following');
            $table->text('job-bookmarks');
            $table->text('suggestions');
            $table->string('date-of-birth');
            $table->string('member-url-resources');
            $table->string('related-profile-views');
            $table->string('honors-awards');
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
