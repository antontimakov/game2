<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Test1 extends BaseController
{
    function index()
    {
        echo 'hello lara';
        event(new MyEvent(mt_rand(0, 100)));
    }
}
