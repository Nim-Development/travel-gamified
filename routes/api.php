<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'Admin\UserController@all');
Route::get('users/{id}', 'Admin\UserController@single');

Route::get('teams', 'Admin\TeamController@all');
Route::get('teams/{id}', 'Admin\TeamController@single');

Route::get('trips', 'Admin\TripController@all');
Route::get('trips/{id}', 'Admin\TripController@single');

Route::get('tours', 'Admin\TourController@all');
Route::get('tours/{id}', 'Admin\TourController@single');

Route::get('itineraries', 'Admin\ItineraryController@all');
Route::get('itineraries/{id}', 'Admin\ItineraryController@single');

Route::get('cities', 'Admin\CityController@all');
Route::get('cities/{id}', 'Admin\CityController@single');

Route::get('transits', 'Admin\TransitController@all');
Route::get('transits/{id}', 'Admin\TransitController@single');

Route::get('routes', 'Admin\RouteController@all');
Route::get('routes/{id}', 'Admin\RouteController@single');

Route::get('challenges', 'Admin\ChallengeController@all'); // returns all challenges
Route::get('challenges/{id}', 'Admin\ChallengeController@single'); // gets single challenge by id
Route::get('challenges/playfield/{type}', 'Admin\ChallengeController@all_by_playfield'); // gets all challenges with the playfield type of {playfield}
Route::get('challenges/game/{type}', 'Admin\ChallengeController@all_by_game'); // gets all challenges with the game type of {game}

Route::get('answeres/{filter}', 'Admin\AnswereController@all'); // filter: all, unchecked, checked
Route::get('answeres/{filter}/{id}', 'Admin\AnswereController@single'); // filter: all, unchecked, checked

Route::get('games/multiple_choice/options', 'Admin\GameController@ALL_multiple_choice_options');
Route::get('games/multiple_choice/{id}/options', 'Admin\GameController@SINGLE_multiple_choice_options');

// Route::get('games/type/{filter}', 'Admin\GameController@all'); // filter: all, media_upload, text_answere, multiple_choice
// Route::get('games/{filter}/{id}', 'Admin\GameController@single'); // filter: all, media_upload, text_answere, multiple_choice


/**
 * POST
 */

 Route::post('challenges/add', 'Admin\ChallengeController@add');
