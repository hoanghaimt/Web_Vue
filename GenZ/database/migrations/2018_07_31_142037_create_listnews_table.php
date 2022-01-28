<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listnews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_name');
            $table->integer('list_number')->nullable();
            $table->integer('list_type')->default(0);
            $table->text('list_icon')->nullable();
            $table->text('list_description')->nullable();
            $table->text('list_slug');
            $table->integer('id_modnews')->unsigned();
            $table->foreign('id_modnews')->references('id')->on('modnews')->onDelete('cascade');
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
        Schema::dropIfExists('listnews');
    }
}
