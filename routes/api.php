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

Route::get('trips', 'Admin\TripController@all');
Route::get('trips/{id}', 'Admin\TripController@single');
Route::get('trips/paginate/{qty}', 'Admin\TripController@paginate');

Route::get('tours', 'Admin\TourController@all');
Route::get('tours/{id}', 'Admin\TourController@single');
Route::get('tours/paginate/{id}', 'Admin\TourController@paginate');

Route::get('itineraries', 'Admin\ItineraryController@all');
Route::get('itineraries/{id}', 'Admin\ItineraryController@single');
Route::get('itineraries/paginate/{qty}', 'Admin\ItineraryController@paginate');
Route::get('itineraries/playfield/{playfield}', 'Admin\ItineraryController@all_by_playfield'); //all with specific playfield type
Route::get('itineraries/playfield/{playfield}/paginate/{qty}', 'Admin\ItineraryController@paginate_by_playfield'); //all with specific playfield type PAGINATED

Route::get('cities', 'Admin\CityController@all');
Route::get('cities/paginate/{qty}', 'Admin\CityController@paginate');
Route::get('cities/{id}', 'Admin\CityController@single');

Route::get('transits', 'Admin\TransitController@all');
Route::get('transits/{id}', 'Admin\TransitController@single');
Route::get('transits/paginate/{qty}', 'Admin\TransitController@paginate');

Route::get('routes', 'Admin\RouteController@all');
Route::get('routes/{id}', 'Admin\RouteController@single');
Route::get('routes/paginate/{qty}', 'Admin\RouteController@paginate');

Route::get('challenges', 'Admin\ChallengeController@all'); // returns all challenges
Route::get('challenges/paginate/{qty}', 'Admin\ChallengeController@paginated');
Route::get('challenges/{id}', 'Admin\ChallengeController@single'); // gets single challenge by id
Route::get('challenges/playfield/{type}', 'Admin\ChallengeController@all_by_playfield'); // gets all challenges with the playfield type of {playfield}
Route::get('challenges/game/{type}', 'Admin\ChallengeController@all_by_game'); // gets all challenges with the game type of {game}
Route::get('challenges/playfield/{type}/paginate/{qty}', 'Admin\ChallengeController@paginated_by_playfield'); // gets all challenges with the playfield type of {playfield}
Route::get('challenges/game/{type}/paginate/{qty}', 'Admin\ChallengeController@paginated_by_game'); // gets all challenges with the game type of {game}


Route::get('answeres/{type}', 'Admin\AnswereController@all'); // types: unchecked, checked
Route::get('answeres/{type}/{id}', 'Admin\AnswereController@single'); // type: unchecked, checked
Route::get('answeres/{type}/paginate/{qty}', 'Admin\AnswereController@paginate');


Route::get('games/media_upload', 'Admin\GameMediaUploadController@all');
Route::get('games/media_upload/{id}', 'Admin\GameMediaUploadController@single');
Route::get('games/media_upload/paginate/{qty}', 'Admin\GameMediaUploadController@paginate');

Route::get('games/text_answere', 'Admin\GameTextAnswereController@all');
Route::get('games/text_answere/{id}', 'Admin\GameTextAnswereController@single');
Route::get('games/text_answere/paginate/{qty}', 'Admin\GameTextAnswereController@paginate');

Route::get('games/multiple_choice', 'Admin\GameMultipleChoiceController@all');
Route::get('games/multiple_choice/paginate/{qty}', 'Admin\GameMultipleChoiceController@paginate');
Route::get('games/multiple_choice/options', 'Admin\GameMultipleChoiceController@all_options');
Route::get('games/multiple_choice/options/paginate/{qty}', 'Admin\GameMultipleChoiceController@paginated_options');
Route::get('games/multiple_choice/{id}', 'Admin\GameMultipleChoiceController@single');
Route::get('games/multiple_choice/{id}/options', 'Admin\GameMultipleChoiceController@single_game_options'); //options of single game



/**
 * POST
 */
Route::post('challenges/add', 'Admin\ChallengeController@add');
