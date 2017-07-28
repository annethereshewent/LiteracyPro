<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('band_id')->unsigned();
            $table->foreign('band_id')->references('id')->on('band')->onDelete('cascade');
            $table->string('name');
            $table->timestamp('recorded_date')->nullable();
            $table->timestamp('release_date')->nullable();
            $table->integer('number_of_tracks');
            $table->string('label');
            $table->string('producer');
            $table->string('genre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album');
    }
}
