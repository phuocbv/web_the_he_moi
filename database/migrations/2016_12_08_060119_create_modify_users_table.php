<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('password')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->string('phone')->unique()->nullable();
            $table->string('facebook_id')->unique()->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->string('twitter_id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->string('password')->change();
            $table->string('email')->nullable(false)->change();
            $table->dropColumn(['avatar', 'is_active', 'is_admin', 'phone', 'facebook_id', 'google_id', 'twitter_id']);
        });
    }
}
