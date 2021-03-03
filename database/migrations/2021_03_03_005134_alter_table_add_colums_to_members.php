<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAddColumsToMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->text('avatar')->nullable()->after('id_spec');
            $table->text('rise')->nullable()->after('id_spec');
            $table->text('weight')->nullable()->after('id_spec');
            $table->date('DOB')->nullable()->after('id_spec');
            $table->text('city')->nullable()->after('id_spec');
            $table->text('address')->nullable()->after('id_spec');
            $table->text('home')->nullable()->after('id_spec');
            $table->text('male')->nullable()->after('id_spec');
            $table->text('phone')->nullable()->after('id_spec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
