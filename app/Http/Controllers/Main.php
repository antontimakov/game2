<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Main extends BaseController
{
    function index()
    {
        $oldPlayerState = DB::table('main.player')
            -> where('id', '=', 1)
            -> first();
        $res = [
            'damage' => 0,
            'hpPlayer' => $oldPlayerState -> hit_points,
            'hpEnemy' => 0,
            'expPlayer' => $oldPlayerState -> experience,
            'goldPlayer' => $oldPlayerState -> gold
        ];
        return $res;
    }
}
