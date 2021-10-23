<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaconTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lot');
            $table->string('kp');
            $table->string('item');
            $table->string('lusi');
            $table->double('ball1');
            $table->double('kg1');
            $table->double('cones1');
            $table->string('pakan');
            $table->double('ball2');
            $table->double('kg2');
            $table->double('cones2');
            $table->string('sisir');
            $table->string('te');
            $table->string('w');
            $table->double('p');
            $table->double('susut');
            $table->string('actual');
            $table->integer('user_id')->unsigned();
            $table->integer('koreksi');
            $table->integer('print')->default(0);
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
        Schema::dropIfExists('sacon');
    }
}
