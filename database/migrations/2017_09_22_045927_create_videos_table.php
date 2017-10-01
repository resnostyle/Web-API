<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->enum('type', [0, 1, 2]);
            $table->string('title');
            $table->text('aliases');
            $table->string('country');
            $table->dateTime('started');
            $table->mediumInteger('anidb');
            $table->mediumInteger('imdb');
            $table->mediumInteger('tmdb');
            $table->mediumInteger('trakt');
            $table->mediumInteger('tvdb');
            $table->mediumInteger('tvmaze');
            $table->mediumInteger('tvrage');
            $table->integer('source');
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
        Schema::dropIfExists('videos');
    }
}
