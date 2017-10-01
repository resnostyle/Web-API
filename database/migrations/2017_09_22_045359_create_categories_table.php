<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedMediumInteger('id');
            $table->string('title');
            $table->integer('parent_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('description')->nullable();
            $table->boolean('disable_preview')->default(false);
            $table->bigInteger('min_size')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
