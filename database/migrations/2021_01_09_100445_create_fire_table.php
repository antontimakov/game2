<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('number_fires')->default(0)->comment('Кол-во выстрелов');
            $table->integer('damage')->default(0)->comment('Урон');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fire');
    }
}
