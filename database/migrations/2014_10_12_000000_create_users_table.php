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
            $table->string('user_name');
            $table->string('linkedin_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('sex');
            $table->string('nationality');
            $table->string('user_type');
            $table->string('phone_number_mobile');
            $table->string('phone_number_home');
            $table->string('phone_number_work');
            $table->string('twitter_account_name1');
            $table->string('twitter_account_name2');

            $table->string('company_name');   
            $table->string('company_type');       
            $table->string('website_url');      
            $table->string('industries');                            
            $table->string('employee_count_range');     
            $table->text('specialties');    
            $table->text('locations');  
            $table->string('company_phone1');     
            $table->string('company_phone2');     
            $table->string('company_fax');        
            $table->text('description');        
            $table->string('stock_exchange');       
            $table->string('founded_year');
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