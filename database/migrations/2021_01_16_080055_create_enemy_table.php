<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnemyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main.enemy', function (Blueprint $table) {
            $table->id();
            $table->text('name')->default('')->comment('Наименование');
            $table->integer('hit_points')->default(0)->comment('Кол-во очков здоровья');
            $table->integer('mana_points')->default(0)->comment('Кол-во очков маны');
            $table->integer('experience')->default(0)->comment('Кол-во опыта за победу');
            $table->integer('gold')->default(0)->comment('Кол-во золота за победу');
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
        Schema::dropIfExists('main.enemy');
    }
}
