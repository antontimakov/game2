<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main.player', function (Blueprint $table) {
            $table->id();
            $table->text('name')->default('')->comment('Наименование');
            $table->integer('hit_points')->default(0)->comment('Кол-во очков здоровья');
            $table->integer('mana_points')->default(0)->comment('Кол-во очков маны');
            $table->integer('experience')->default(0)->comment('Кол-во опыта');
            $table->integer('gold')->default(0)->comment('Кол-во золота');
            $table->dateTimeTz('resurrection_time')->nullable()->comment('Время до воскрешения');
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
        Schema::dropIfExists('main.player');
    }
}
