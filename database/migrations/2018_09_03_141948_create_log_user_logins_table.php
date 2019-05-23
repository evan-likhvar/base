<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogUserLoginsTable extends Migration
{
    public function up()
    {
        Schema::create('log_user_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->ipAddress('ip')->index()->nullable();
            $table->timestamp('date')->index();

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_user_logins', function (Blueprint $table) {
            Schema::dropIfExists('log_user_logins');
        });
    }
}
