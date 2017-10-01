<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNzedbUserFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',
            function (Blueprint $table) {
                $table->integer('role_id')->default(2);
                $table->integer('invites')->default(0);
                $table->integer('invited_by')->nullable();
                $table->text('preferences')->nullable();
                $table->timestamp('last_login')->default(now());
                $table->timestamp('last_api_access')->default(now());
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn(['role_id', 'invites', 'invited_by', 'preferences']);
        });
    }
}
