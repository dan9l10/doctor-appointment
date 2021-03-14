<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableChangeColumnTimeToMeets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meets', function (Blueprint $table) {
            //$table->renameColumn('time','time_id');
            $table->integer('time')->unsigned()->change();
            $table->foreign('time')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meets', function (Blueprint $table) {
            //
        });
    }
}
