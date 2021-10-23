<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndigoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indigo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lot');
            $table->string('mc_idg');
            $table->string('nb');
            $table->string('te');
            $table->string('w');
            $table->double('p');
            $table->double('b');
            $table->integer('sacon_id')->unsigned();
            $table->integer('warping_id')->default(0)->unsigned();
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
        Schema::dropIfExists('indigo');
    }
}
