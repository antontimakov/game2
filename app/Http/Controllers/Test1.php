<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Test1 extends BaseController
{
    function index()
    {
        $resBattle = DB::table('main.battle')
            -> where('player_id', '=', 1);
        if ($resBattle -> count() === 0){
            $resEnemy = DB::table('main.enemy')
                -> first();
            DB::table('main.battle')->insert([
                'player_id' => 1,
                'hit_points' => $resEnemy -> hit_points,
                'mana_points' => $resEnemy -> mana_points
            ]);
        }

        // Урон врагу
        $dmg = mt_rand(0, 100);
        $oldBattleState = $resBattle
            -> first();
        DB::table('main.battle')
            -> update(['hit_points' => $oldBattleState -> hit_points - $dmg]);

        // Урон игроку
        $oldPlayerState = DB::table('main.player')
            -> where('id', '=', 1)
            -> first();
        DB::table('main.player')
            -> update(['hit_points' => $oldPlayerState -> hit_points - 5]);

        // Игрок проиграл
        if ($oldPlayerState -> hit_points - 5 <= 0){

            $res = [
                'hpPlayer' => 0,
                'hpEnemy' => $oldBattleState -> hit_points - $dmg
            ];
            //event(new MyEvent($res));

            sleep(30);

            DB::table('main.battle')
                ->where('player_id', '=', 1)
                ->delete();
            DB::table('main.player')
                -> update(['hit_points' => 100]);
            $res = [
                'hpPlayer' => 100,
                'hpEnemy' => $oldBattleState -> hit_points - $dmg
            ];
            //event(new MyEvent($res));

        }
        else{
            $res = [
                'hpPlayer' => $oldPlayerState -> hit_points - 5,
                'hpEnemy' => $oldBattleState -> hit_points - $dmg,
                'expPlayer' => $oldPlayerState -> experience,
                'goldPlayer' => $oldPlayerState -> gold
            ];
            return $res;
            //event(new MyEvent($res));
        }
    }
}
