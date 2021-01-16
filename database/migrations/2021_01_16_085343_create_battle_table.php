<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main.battle', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->comment('Игрок');
            $table->integer('hit_points')->default(0)->comment('Кол-во очков здоровья');
            $table->integer('mana_points')->default(0)->comment('Кол-во очков маны');
            $table->timestamps();

            $table->foreign('player_id')->references('id')
                ->on('main.player')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main.battle', function (Blueprint $table) {
            $table->dropForeign(['player_id']); // Удаление индекса 'geo_state_index'
        });
        Schema::dropIfExists('main.battle');
    }
}
