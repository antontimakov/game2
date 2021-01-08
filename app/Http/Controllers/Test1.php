<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Test1 extends BaseController
{
    function index()
    {
        event(new MyEvent('hello world'));
    }
}
