<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Tour;

use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Trip as TripResource;

class TripController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $all = Trip::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TripResource::collection($all);
    }

    // Single entry by id
    public function single($id)
    {
        return new TripResource(Trip::findOrFail($id));
    }

    public function paginate($qty)
    {
        $all = Trip::paginate($qty);
        
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TripResource::collection($all);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|integer',
            'name' => 'required|string',
            'timezone' => 'required|string',
            'start_date_time' => 'required|date',
            'teams.*' => 'numeric'
        ]);

        // check if relational data actually exists
        if($request->tour_id){
            if(!Tour::find($request->tour_id)){
                // Error: can't create answere for non existent challenge!
                return response()->json(['error' => 'Can not add Trip to non existing Tour (id: '.$request->tour_id.')'], 422);
            }
        }

        // LOOP!
        // check if relational teams actually exists first!
        if($request->teams){
            foreach ($request->teams as $team_id) {
                if(!Team::find($team_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not add non existing Team relationship (id: '.$user_id.') to Trip.'], 422);
                }
            }
        }
        
        // create the 
        $trip = Trip::create([
            'tour_id' => $request->tour_id, 
            'name' => $request->name, 
            'timezone' => $request->timezone, 
            'start_date_time' => $request->start_date_time
        ]);

        // LOOP OVER TEAMS AND ADJUST THEIR TRIP_ID
        if($request->teams){
            foreach ($request->teams as $team_id) {
                // save relational team to the trip
                $trip->teams()->save(
                    Team::find($team_id)
                );
            }
        }

        // return Resource
        return (new TripResource($trip))
                                ->response()
                                ->setStatusCode(201);
    }
}
