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
            $table->integer('company_id');
            $table->string('company_name'); 
            $table->string('universal-name');   
            $table->text('email-domains');  
            $table->string('company-type');     
            $table->text('ticker');     
            $table->string('website-url');      
            $table->string('industries');       
            $table->string('status');       
            $table->string('logo-url');     
            $table->string('square-logo-url');      
            $table->string('blog-rss-url');     
            $table->string('twitter-id');       
            $table->string('employee-count-range');     
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
            $table->string('stock-exchange');       
            $table->string('founded-year');     
            $table->string('end-year');     
            $table->string('num-followers');
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
