<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthResetLoginRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_reset_login_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('ip')->index();
            $table->timestamp('date')->index();
            $table->unsignedSmallInteger('count')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_reset_login_requests');
    }
}
