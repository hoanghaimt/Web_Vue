<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modnews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mod_name');
            $table->integer('mod_number')->nullable();
            $table->integer('mod_type')->default(0);
            $table->text('mod_icon')->nullable();
            $table->text('mod_description')->nullable();
            $table->text('mod_slug');
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
        Schema::dropIfExists('modnews');
    }
}
