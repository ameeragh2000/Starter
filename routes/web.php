<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {

    return 'home';
});
Route::get('landing',function (){
   return view('landing');
});
Route::get('about',function (){
    return view('about');
});
Route::get('test1', function () {
    return "welcom";
})->name('a');

//route parameters
Route::get('/test2/{id}', function ($id) {
    return $id;
})->name('b');

//route name
Route::namespace('front')->group(function(){
  Route::get('user','UserController@showUserName');
});

/*Route::prefix('users')->group(function (){
    Route::get('show','UserController@showUserName');
    Route::delete('delete','UserController@showUserName');
    Route::get('edit','UserController@showUserName');
    Route::put('update','UserController@showUserName');
});*/

Route::group(['prefix'=>'users','middleware'=>'auth'],function(){
    Route::get('/',function (){
       return "work";
    });
    Route::get('show','UserController@showUserName');
    Route::delete('delete','UserController@showUserName');
    Route::get('edit','UserController@showUserName');
    Route::put('update','UserController@showUserName');
});
Route::get('check',function (){
    return "middleware";
}) -> middleware('auth');

//Route::get('second','Admin\SecondController@secondfun');

Route::group(['namespace'=>'Admin'] , function (){
    Route::get('second','SecondController@secondfun')->middleware('auth');
    Route::get('second2','SecondController@secondfun2');
    Route::get('second3','SecondController@secondfun3');
});

Route::get('login',function (){
    return 'must be run after that';
})->name('login');

Route::resource('news','NewsController');

Route::get('index','Front\UserController@getIndex');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('fillable','CrudController@getOffers');
Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){
   // Route::get('store','CrudController@store');
    Route::group(['prefix'=>'offer'],function (){
        Route::get('create','CrudController@create');
        Route::post('store','CrudController@store')->name('offer.store');
   });

});
