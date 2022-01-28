<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbordersproductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbordersproduct', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_pro_name');
            $table->integer('order_pro_qty');
            $table->integer('order_pro_price');
            $table->integer('order_pro_total');
            $table->integer('id_product')->unsigned();
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            $table->integer('id_dborder')->unsigned();
            $table->foreign('id_dborder')->references('id')->on('dborders')->onDelete('cascade');
            $table->string('comment');
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
        Schema::dropIfExists('dbordersproduct');
    }
}
