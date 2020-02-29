<?php

////////////////////
// AUTH: NO TOKEN //
////////////////////
Route::group(['namespace' => 'Auth\Passport'], function () {
    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AuthController@register');

    Route::group(['prefix' => 'password/reset'], function () {
        Route::get('find/{token}', 'PasswordResetController@find_reset_token');
        Route::post('request/token', 'PasswordResetController@request_reset_token');
        Route::post('', 'PasswordResetController@update_password');
    });
});

//////////////////////////
// AUTH: TOKEN REQUIRED //
//////////////////////////
Route::group(['middleware' => 'auth:api'], function () {  

    // Auth related routes
    Route::group(['namespace' => 'Auth\Passport'], function () {
    
        // user related
        Route::get('auth/details', 'AuthController@details');
        Route::get('auth/logout', 'AuthController@logout');
        Route::post('auth/update/password', 'AuthController@update_password');
        Route::delete('auth/delete', 'AuthController@destroy');
       
    });
});

////////////////////////////
// PERMISSION LEVEL ADMIN //
////////////////////////////
Route::group(['middleware' => 'auth:api'], function () {  

    Route::group([
        'middleware' => ['admin'], 
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function() {

        /** ADMINS ONLY */
        Route::prefix('users')->group(function () {
            Route::get('', 'UserController@all');
            Route::get('{id}', 'UserController@single');
            Route::get('paginate/{qty}', 'UserController@paginate');
        });
    
        Route::prefix('teams')->group(function () {
            Route::get('', 'TeamController@all');
            Route::get('{id}', 'TeamController@single');
            Route::get('paginate/{qty}', 'TeamController@paginate');
            Route::post('', 'TeamController@store');
            Route::put('{id}', 'TeamController@update');
            Route::delete('{id}', 'TeamController@destroy');
        });
    
        Route::prefix('trips')->group(function () {
            Route::get('', 'TripController@all');
            Route::get('{id}', 'TripController@single');
            Route::get('paginate/{qty}', 'TripController@paginate');
            Route::post('', 'TripController@store');
            Route::put('{id}', 'TripController@update');
            Route::delete('{id}', 'TripController@destroy');
        });
    
        Route::prefix('tours')->group(function () {
            Route::get('', 'TourController@all');
            Route::get('{id}', 'TourController@single');
            Route::get('paginate/{id}', 'TourController@paginate');
            Route::post('', 'TourController@store');
            Route::put('{id}', 'TourController@update');
            Route::delete('{id}', 'TourController@destroy');
        });
    
        Route::prefix('itineraries')->group(function () {
            Route::get('', 'ItineraryController@all');
            Route::get('{id}', 'ItineraryController@single');
            Route::get('paginate/{qty}', 'ItineraryController@paginate');
            Route::get('playfield/{playfield}', 'ItineraryController@all_by_playfield');
            Route::get('playfield/{playfield}/paginate/{qty}', 'ItineraryController@paginate_by_playfield');
            Route::post('', 'ItineraryController@store');
            Route::put('sort/{id}', 'ItineraryController@sort');
            Route::put('{id}', 'ItineraryController@update');
            Route::delete('{id}', 'ItineraryController@destroy');
        });
    
        Route::prefix('cities')->group(function () {
            Route::get('', 'CityController@all');
            Route::get('paginate/{qty}', 'CityController@paginate');
            Route::get('{id}', 'CityController@single');
            Route::post('', 'CityController@store');
            Route::put('{id}', 'CityController@update');
            Route::delete('{id}', 'CityController@destroy');
        });
    
        Route::prefix('transits')->group(function () {
            Route::get('', 'TransitController@all');
            Route::get('{id}', 'TransitController@single');
            Route::get('paginate/{qty}', 'TransitController@paginate');
            Route::post('', 'TransitController@store');
            Route::put('{id}', 'TransitController@update');
            Route::delete('{id}', 'TransitController@destroy');
        });
    
    
        Route::prefix('routes')->group(function () {
            Route::get('', 'RouteController@all');
            Route::get('{id}', 'RouteController@single');
            Route::get('paginate/{qty}', 'RouteController@paginate');
            Route::post('', 'RouteController@store');
            Route::put('{id}', 'RouteController@update');
            Route::delete('{id}', 'RouteController@destroy');
        });
    
        Route::prefix('challenges')->group(function () {
            Route::get('', 'ChallengeController@all'); // returns all challenges
            Route::get('paginate/{qty}', 'ChallengeController@paginated');
            Route::get('{id}', 'ChallengeController@single'); // gets single challenge by id
            Route::get('playfield/{type}', 'ChallengeController@all_by_playfield'); // gets all challenges with the playfield type of {playfield}
            Route::get('game/{type}', 'ChallengeController@all_by_game'); // gets all challenges with the game type of {game}
            Route::get('playfield/{type}/paginate/{qty}', 'ChallengeController@paginated_by_playfield'); // gets all challenges with the playfield type of {playfield}
            Route::get('game/{type}/paginate/{qty}', 'ChallengeController@paginated_by_game'); // gets all challenges with the game type of {game}
            Route::post('', 'ChallengeController@store');
            Route::put('{id}', 'ChallengeController@update');
            Route::delete('{id}', 'ChallengeController@destroy');
        });
    
        Route::prefix('answeres')->group(function () {
            Route::get('{type}', 'AnswereController@all'); // types: unchecked, checked
            Route::get('{type}/{id}', 'AnswereController@single'); // type: unchecked, checked
            Route::get('{type}/paginate/{qty}', 'AnswereController@paginate');
            Route::post('{type}', 'AnswereController@store');
            Route::put('{type}/{id}', 'AnswereController@update');
            Route::delete('{type}/{id}', 'AnswereController@destroy');
        });
    
        Route::prefix('games/media_upload')->group(function () {
            Route::get('', 'GameMediaUploadController@all');
            Route::get('{id}', 'GameMediaUploadController@single');
            Route::get('paginate/{qty}', 'GameMediaUploadController@paginate');
            Route::post('', 'GameMediaUploadController@store');
            Route::put('{id}', 'GameMediaUploadController@update');
            Route::delete('{id}', 'GameMediaUploadController@destroy');
        });
    
    
        Route::prefix('games/text_answere')->group(function () {
            Route::get('', 'GameTextAnswereController@all');
            Route::get('{id}', 'GameTextAnswereController@single');
            Route::get('paginate/{qty}', 'GameTextAnswereController@paginate');
            Route::post('', 'GameTextAnswereController@store');
            Route::put('{id}', 'GameTextAnswereController@update');
            Route::delete('{id}', 'GameTextAnswereController@destroy');
        });
    
        Route::prefix('games/multiple_choice')->group(function () {
            Route::get('', 'GameMultipleChoiceController@all');
            Route::get('paginate/{qty}', 'GameMultipleChoiceController@paginate');
            Route::get('options', 'GameMultipleChoiceController@all_options');
            Route::get('options/paginate/{qty}', 'GameMultipleChoiceController@paginated_options');
            Route::get('{id}', 'GameMultipleChoiceController@single');
            Route::get('{id}/options', 'GameMultipleChoiceController@single_game_options'); //options of single game
            Route::post('', 'GameMultipleChoiceController@store');
            Route::put('{id}', 'GameMultipleChoiceController@update');
            Route::delete('{id}', 'GameMultipleChoiceController@destroy');
        });

        /****************/

    });

    // ///////////////////////////////
    // // PERMISSION LEVEL CUSTOMER //
    // ///////////////////////////////
    // Route::group(['prefix' => 'customer'], function () {
    //     Route::get('test', function() {
    //         return response()->json(['Can access customer route!, admin could also do this.'], 200);
    //     });
    // });

});



/////////////////////////////////////////////
// Untested Dashboard Maps application API //
/////////////////////////////////////////////
Route::prefix('map')->group(function () {
    Route::get('', 'MapController@refresh');
});