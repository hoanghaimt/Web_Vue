<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_name');
            $table->string('news_slug');
            $table->string('news_video')->nullable();
            $table->text('news_intro');
            $table->text('news_content');
            $table->text('news_image');
            $table->string('news_keywords')->nullable();
            $table->string('news_tags')->nullable();
            $table->integer('news_number')->default(1);
            $table->integer('news_viewcound')->default(0);
            $table->integer('id_listnews')->unsigned();
            $table->foreign('id_listnews')->references('id')->on('listnews')->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
}
