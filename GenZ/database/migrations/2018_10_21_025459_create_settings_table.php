<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('map')->nullable();            
            $table->string('nameco')->nullable();
            $table->string('address')->nullable();  
            $table->string('phone')->nullable();  
            $table->string('mail')->nullable();  
            $table->string('logo')->nullable();  
            $table->string('slogan')->nullable();  
            $table->string('fanpage')->nullable();  
            $table->string('seo_title')->nullable();  
            $table->string('seo_keyword')->nullable();  
            $table->string('seo_description')->nullable();  
            $table->string('seo_image')->nullable();  
            $table->string('fb_app_id')->nullable();  
            $table->string('google_analyst')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
