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

   return view('dashboard.cockpit.sales');

})->name('sales');


Route::group([
   // 'middleware' => ['admin'], 
   'namespace' => 'Dashboard'
], function() {

   // Cockpits
   Route::prefix('cockpits')->group(function () { 
      Route::get('sales', 'CockpitController@sales')->name('sales');
   });

   // Tours
   Route::prefix('tours')->group(function () { 
      Route::get('', 'TourController@index')->name('tours');
      Route::get('active',  'TourController@active')->name('tours.active');
      Route::get('inactive', 'TourController@inactive')->name('tours.inactive');
      Route::get('{id}', 'TourController@show')->name('tour');
   });
});


Route::get('/test', function(){
   TimeConverter::secondsToDhm(300000);
   dd(TimeConverter::dhmToSeconds(3, 11, 20));
   dd(
      TimeConverter::getDays(),
      TimeConverter::getHours(),
      TimeConverter::getMinutes()
   );
});

