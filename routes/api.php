<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * GET
 */
Route::get('users', 'Admin\UserController@all');
Route::get('users/{id}', 'Admin\UserController@single');
Route::get('users/paginate/{qty}', 'Admin\UserController@paginate');

Route::get('teams', 'Admin\TeamController@all');
Route::get('teams/{id}', 'Admin\TeamController@single');
Route::get('teams/paginate/{qty}', 'Admin\TeamController@paginate');
Route::post('teams', 'Admin\TeamController@store'); // temp used to get some test files into the system
Route::put('teams/{id}', 'Admin\TeamController@update');


Route::get('trips', 'Admin\TripController@all');
Route::get('trips/{id}', 'Admin\TripController@single');
Route::get('trips/paginate/{qty}', 'Admin\TripController@paginate');
Route::post('trips', 'Admin\TripController@store');
Route::put('trips/{id}', 'Admin\TripController@update');

Route::get('tours', 'Admin\TourController@all');
Route::get('tours/{id}', 'Admin\TourController@single');
Route::get('tours/paginate/{id}', 'Admin\TourController@paginate');
Route::post('tours', 'Admin\TourController@store');
Route::put('tours/{id}', 'Admin\TourController@update');

Route::get('itineraries', 'Admin\ItineraryController@all');
Route::get('itineraries/{id}', 'Admin\ItineraryController@single');
Route::get('itineraries/paginate/{qty}', 'Admin\ItineraryController@paginate');
Route::get('itineraries/playfield/{playfield}', 'Admin\ItineraryController@all_by_playfield'); //all with specific playfield type
Route::get('itineraries/playfield/{playfield}/paginate/{qty}', 'Admin\ItineraryController@paginate_by_playfield'); //all with specific playfield type PAGINATED
Route::post('itineraries', 'Admin\ItineraryController@store');
Route::put('itineraries/{id}', 'Admin\ItineraryController@update');


Route::get('cities', 'Admin\CityController@all');
Route::get('cities/paginate/{qty}', 'Admin\CityController@paginate');
Route::get('cities/{id}', 'Admin\CityController@single');
Route::post('cities', 'Admin\CityController@store');
Route::put('cities/{id}', 'Admin\CityController@update');

Route::get('transits', 'Admin\TransitController@all');
Route::get('transits/{id}', 'Admin\TransitController@single');
Route::get('transits/paginate/{qty}', 'Admin\TransitController@paginate');
Route::post('transits', 'Admin\TransitController@store');
Route::put('transits/{id}', 'Admin\TransitController@update');


Route::get('routes', 'Admin\RouteController@all');
Route::get('routes/{id}', 'Admin\RouteController@single');
Route::get('routes/paginate/{qty}', 'Admin\RouteController@paginate');
Route::post('routes', 'Admin\RouteController@store');
Route::put('routes/{id}', 'Admin\RouteController@update');

Route::get('challenges', 'Admin\ChallengeController@all'); // returns all challenges
Route::get('challenges/paginate/{qty}', 'Admin\ChallengeController@paginated');
Route::get('challenges/{id}', 'Admin\ChallengeController@single'); // gets single challenge by id
Route::get('challenges/playfield/{type}', 'Admin\ChallengeController@all_by_playfield'); // gets all challenges with the playfield type of {playfield}
Route::get('challenges/game/{type}', 'Admin\ChallengeController@all_by_game'); // gets all challenges with the game type of {game}
Route::get('challenges/playfield/{type}/paginate/{qty}', 'Admin\ChallengeController@paginated_by_playfield'); // gets all challenges with the playfield type of {playfield}
Route::get('challenges/game/{type}/paginate/{qty}', 'Admin\ChallengeController@paginated_by_game'); // gets all challenges with the game type of {game}
Route::post('challenges', 'Admin\ChallengeController@store');
Route::put('challenges/{id}', 'Admin\ChallengeController@update');

Route::get('answeres/{type}', 'Admin\AnswereController@all'); // types: unchecked, checked
Route::get('answeres/{type}/{id}', 'Admin\AnswereController@single'); // type: unchecked, checked
Route::get('answeres/{type}/paginate/{qty}', 'Admin\AnswereController@paginate');
Route::post('answeres/{type}', 'Admin\AnswereController@store');
Route::put('answeres/{type}/{id}', 'Admin\AnswereController@update');

Route::get('games/media_upload', 'Admin\GameMediaUploadController@all');
Route::get('games/media_upload/{id}', 'Admin\GameMediaUploadController@single');
Route::get('games/media_upload/paginate/{qty}', 'Admin\GameMediaUploadController@paginate');
Route::post('games/media_upload', 'Admin\GameMediaUploadController@store');
Route::put('games/media_upload/{id}', 'Admin\GameMediaUploadController@update');

Route::get('games/text_answere', 'Admin\GameTextAnswereController@all');
Route::get('games/text_answere/{id}', 'Admin\GameTextAnswereController@single');
Route::get('games/text_answere/paginate/{qty}', 'Admin\GameTextAnswereController@paginate');
Route::post('games/text_answere', 'Admin\GameTextAnswereController@store');
Route::put('games/text_answere/{id}', 'Admin\GameTextAnswereController@update');


Route::get('games/multiple_choice', 'Admin\GameMultipleChoiceController@all');
Route::get('games/multiple_choice/paginate/{qty}', 'Admin\GameMultipleChoiceController@paginate');
Route::get('games/multiple_choice/options', 'Admin\GameMultipleChoiceController@all_options');
Route::get('games/multiple_choice/options/paginate/{qty}', 'Admin\GameMultipleChoiceController@paginated_options');
Route::get('games/multiple_choice/{id}', 'Admin\GameMultipleChoiceController@single');
Route::get('games/multiple_choice/{id}/options', 'Admin\GameMultipleChoiceController@single_game_options'); //options of single game
Route::post('games/multiple_choice', 'Admin\GameMultipleChoiceController@store');
Route::put('games/multiple_choice/{id}', 'Admin\GameMultipleChoiceController@update');


/**
 * POST
 */
Route::post('challenges/add', 'Admin\ChallengeController@add');
