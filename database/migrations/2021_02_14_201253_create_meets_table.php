<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meets', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_doc')->unsigned();
            $table->foreign('id_doc')->references('id')->on('members');

            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('members');

            $table->time('time');
            $table->date('date');

            $table->string('complaint')->nullable();
            $table->string('diagnosis')->nullable();


            $table->boolean('status')->default(0);


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
        Schema::dropIfExists('meets');
    }
}
