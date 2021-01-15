<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Test1 extends BaseController
{
    function index()
    {
        $dmg = mt_rand(0, 100);
        $res = DB::table('fire')->first();

        DB::table('fire')
            -> update(
                [
                    'number_fires' => $res->number_fires + 1,
                    'damage' => $res->damage + $dmg
                ]
            );
        event(new MyEvent($res->damage + $dmg . ' (' . $dmg . ')'));
        //return 1;
    }
}
