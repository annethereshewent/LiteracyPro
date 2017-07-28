<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAlbumFieldsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album', function (Blueprint $table) {
            $table->integer('number_of_tracks')->nullable()->change();
            $table->string('label')->nullable()->change();
            $table->string('producer')->nullable()->change();
            $table->string('genre')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('album', function (Blueprint $table) {
            //
        });
    }
}
