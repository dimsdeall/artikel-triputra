<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish', function (Blueprint $table) {
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
            $table->integer('user_id')->unsigned();
            $table->integer('print')->default(0);
            $table->integer('koreksi');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('finish');
    }
}
