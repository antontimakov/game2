<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Battle extends BaseController
{
    function index()
    {
        $oldPlayerState = DB::table('main.player')
            -> select(
                    'name',
                    'hit_points',
                    'mana_points',
                    'experience',
                    'gold',
                    DB::raw('resurrection_time - NOW() AS res')
                )
            -> where('id', '=', 1)
            -> first();
        if($oldPlayerState->res > 0){ // ещё не воскресился
            return;
        }
        $resBattle = DB::table('main.battle')
            -> where('player_id', '=', 1);
        $resEnemy = DB::table('main.enemy')
            -> first();
        if ($resBattle -> count() === 0){
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
        DB::table('main.player')
            -> update(['hit_points' => $oldPlayerState -> hit_points - 5]);

        // Игрок проиграл
        if ($oldPlayerState -> hit_points - 5 <= 0){

            $res = [
                'msg' => 'Вы проиграли. Нужно подолжать 30 секунд!'
            ];
            DB::table('main.player')
                -> where('id', '=', 1)
                -> update(['resurrection_time' => DB::raw("NOW()  + interval '30 second'")]);
            event(new MyEvent($res));

            sleep(30);

            DB::table('main.battle')
                ->where('player_id', '=', 1)
                ->delete();
            DB::table('main.player')
                -> update([
                    'hit_points' => 100
                ]);
            $res = [
                'msg' => 'Можно продолжать игру!'
            ];
            event(new MyEvent($res));

        }
        else{
            // Игрок выиграл
            if ($oldBattleState -> hit_points - $dmg <= 0){
                $res = [
                    'msg' => 'Вы Выиграли!'
                ];

                DB::table('main.battle')
                    ->where('player_id', '=', 1)
                    ->delete();
                DB::table('main.player')
                    -> update([
                        'hit_points' => 100,
                        'experience' => $oldPlayerState -> experience + $resEnemy -> experience,
                        'gold' => $oldPlayerState -> gold + $resEnemy -> gold
                    ]);

                event(new MyEvent($res));
                $res = [
                    'damage' => $dmg,
                    'hpPlayer' => 100,
                    'hpEnemy' => $resEnemy -> experience,
                    'expPlayer' => $oldPlayerState -> experience + $resEnemy -> experience,
                    'goldPlayer' => $oldPlayerState -> gold + $resEnemy -> gold
                ];
                return $res;
            }
            else{
                $res = [
                    'damage' => $dmg,
                    'hpPlayer' => $oldPlayerState -> hit_points - 5,
                    'hpEnemy' => $oldBattleState -> hit_points - $dmg,
                    'expPlayer' => $oldPlayerState -> experience,
                    'goldPlayer' => $oldPlayerState -> gold
                ];
                return $res;
            }
        }
    }
}
