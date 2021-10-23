<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishtempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishtemp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('potong');
            $table->string('lot');
            $table->string('grade');
            $table->string('point');
            $table->double('yds');
            $table->double('kg');
            $table->string('lebar');
            $table->string('sn');
            $table->string('k3l');
            $table->string('inisial');
            $table->string('susutlusi');
            $table->string('k');
            $table->string('actual');
            $table->date('tgl');
            $table->integer('sacon_id')->unsigned();
            $table->integer('greige_id')->unsigned();
            $table->integer('finish_id')->unsigned();
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
        Schema::dropIfExists('finishtemp');
    }
}
