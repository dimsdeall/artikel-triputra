<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarpingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lot');
            $table->string('nb');
            $table->string('te');
            $table->double('p');
            $table->double('b');
            $table->integer('sacon_id')->unsigned();
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
        Schema::dropIfExists('warping');
    }
}
