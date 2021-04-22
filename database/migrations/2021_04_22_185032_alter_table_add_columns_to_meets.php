<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddColumnsToMeets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->text('type')->after('complaint');
            $table->text('ticket')->after('complaint')->nullable();
            $table->text('link')->after('complaint')->nullable();
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
