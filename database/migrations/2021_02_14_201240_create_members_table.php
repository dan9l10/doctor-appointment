<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            /*$table->integer('id_role')->unsigned();

            $table->foreign('id_role')->references('id')->on('roles');*/

            $table->integer('id_card')->unsigned()->nullable();

            $table->foreign('id_card')->references('id')->on('medical_cards');


            $table->integer('id_spec')->unsigned()->nullable();
            $table->foreign('id_spec')->references('id')->on('specials');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
