<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreigeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greige', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shift');
            $table->double('b');
            $table->double('p');
            $table->string('sn');
            $table->integer('potongan');
            $table->string('grade');
            $table->string('opr');
            $table->integer('sacon_id')->unsigned();
            $table->integer('weaving_id')->default(0)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('koreksi');
            $table->integer('print')->default(0);
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
        Schema::dropIfExists('greige');
    }
}
