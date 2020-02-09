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
   return redirect(route('sales'));
});

Route::get('/sales', function(){

   return view('admin.cockpit.sales');

})->name('sales');

Route::get('/tours', function(){

   return view('admin.game-development.tours');

})->name('tours');
