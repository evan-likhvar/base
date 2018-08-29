<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableAddInitialFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('language_id')->index()->nullable();
            $table->boolean('dashboard_enable')->index()->default(0);
            $table->boolean('active')->index()->default(0);

            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'language_id')) {
                $table->dropForeign(['language_id']);
            }
            $table->dropColumn('language_id');
            $table->dropColumn('active');
            $table->dropColumn('dashboard_enable');
        });
    }
}
