<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Tour;

use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Trip as TripResource;
use App\Http\Requests\Trip as TripRequest;

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

    public function store(TripRequest $request)
    {
        
        // create the 
        $trip = Trip::create($request->validated());
        $trip->attach_teams($request->teams);

        // return Resource
        return (new TripResource($trip))->response()->setStatusCode(201);
    }

    public function update(TripRequest $request, $id)
    {   
        // create the 
        $trip = Trip::findOrFail($id);
        $trip->update($request->validated());
        $trip->attach_teams($request->teams);

        // return Resource
        return (new TripResource($trip))->response()->setStatusCode(200);
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $trip->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
