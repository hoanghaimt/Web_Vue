<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_name');
            $table->string('pro_lug');
            $table->string('pro_video')->nullable();
            $table->string('pro_image')->default('/images/noimg.jpg');
            $table->integer('pro_price')->default(0);
            $table->integer('pro_sale')->default(0);
            $table->string('pro_unit');
            $table->integer('pro_view')->default(0);
            $table->integer('pro_status')->default(0);
            $table->integer('pro_hide')->default(0);
            $table->text('pro_intro');
            $table->text('pro_content')->nullable();
            $table->text('pro_specs')->nullable();
            $table->integer('list_id')->unsigned();
            $table->foreign('list_id')->references('id')->on('listproducts')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
