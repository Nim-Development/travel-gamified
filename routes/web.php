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
    return view('welcome');
});


Route::get('test', function () {


    //Loop over config keys:
    $res = false;
    foreach(config('models.games') as $key => $value){
        echo $key . '<br>';
        echo substr(get_class($value), 4);
        // if($key == $check_value){
        //     $res = true;
        // }
    }
    die;


    //GameHelper::saySomething();
    ConfigHelper::validate_keyname('1', '2');
});
