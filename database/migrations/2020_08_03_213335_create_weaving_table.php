<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeavingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weaving', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pitem')->nullable();
            $table->string('lot');
            $table->string('mc');
            $table->integer('nb');
            $table->string('pakan');
            $table->string('pick');
            $table->string('sisir');
            $table->string('anyaman');
            $table->string('potongan');
            $table->double('p');
            $table->double('b');
            $table->string('shift');
            $table->string('sn');
            $table->string('opr');
            $table->integer('sacon_id')->unsigned();
            $table->integer('indigo_id')->default(0)->unsigned();
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
        Schema::dropIfExists('weaving');
    }
}
