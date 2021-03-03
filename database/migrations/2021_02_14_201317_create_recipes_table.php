<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_doc')->unsigned();
            $table->foreign('id_doc')->references('id')->on('members');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('members');

            $table->text('signature');
            $table->text('drug');
            $table->text('description');

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
        Schema::dropIfExists('recipes');
    }
}
