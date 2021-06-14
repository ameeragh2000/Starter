<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('secondfun3');
    }

    public function secondfun(){
        return 'static string';
    }
    public function secondfun2(){
        return 'static string2';
    }
    public function secondfun3(){
        return 'static string2';
    }
    //
}
