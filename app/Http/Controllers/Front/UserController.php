<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
  public function showUserName(){
      return "ameera gharaba" ;
  }

  public function getIndex(){
     $obj = new \stdClass();
     $obj->name = 'ameera gharab';
     $obj->id=5 ;
     $data=['ameera','gharaba'];
      return view('welcome',compact('data'));
  }
}
