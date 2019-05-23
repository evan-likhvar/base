<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthIpBlackListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_ip_black_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('active')->index()->default(1);
            $table->ipAddress('ip')->index()->nullable();
            $table->timestamp('date')->index();
            $table->string('comment',60)->index()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_ip_black_lists');
    }
}
