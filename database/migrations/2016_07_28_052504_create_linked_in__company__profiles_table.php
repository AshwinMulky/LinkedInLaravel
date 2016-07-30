<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedInCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_in__company__profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_linkedin_id');
            $table->string('company_name'); 
            $table->string('universal_name');   
            $table->text('email_domains');  
            $table->string('company_type');     
            $table->text('ticker');     
            $table->string('website_url');      
            $table->string('industries');       
            $table->string('status');       
            $table->string('logo_url');     
            $table->string('square_logo_url');      
            $table->string('blog_rss_url');     
            $table->string('twitter_id');       
            $table->string('employee_count_range');     
            $table->text('specialties');    
            $table->text('locations');  
            $table->string('locations_description');    
            $table->string('locations_isheadquarters'); 
            $table->string('locations_isactive');   
            $table->string('locations_address');    
            $table->string('locations_address_street1');        
            $table->string('locations_address_street2');    
            $table->string('locations_address_city');       
            $table->string('locations_address_state');      
            $table->string('locations_address_postalcode'); 
            $table->string('locations_address_countrycode');    
            $table->string('locations_address_regioncode'); 
            $table->text('locations_contactinfo');  
            $table->string('locations_contactinfo_phone1');     
            $table->string('locations_contactinfo_phone2');     
            $table->string('locations_contactinfo_fax');        
            $table->text('description');        
            $table->string('stock_exchange');       
            $table->string('founded_year');     
            $table->string('end_year');     
            $table->string('num_followers');
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
        Schema::drop('linked_in__company__profiles');
    }
}
