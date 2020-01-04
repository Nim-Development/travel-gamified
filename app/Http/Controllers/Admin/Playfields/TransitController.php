<?php

namespace App\Http\Controllers\Admin;

use App\Playfields\City;
use App\Playfields\Route;

use App\Playfields\Transit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Playfields\Transit as TransitResource;

class TransitController extends Controller
{
    // Collection of all entries
    public function all()
    {
            $all = Transit::all();
            if($all->isEmpty()){
                return response()->json(['message' => 'No entries found in database'], 204);
            }
    
            return TransitResource::collection($all);  
    }

    // Single entry by id
    public function single($id)
    {
        return new TransitResource(Transit::findOrFail($id));
    }

    public function paginate($qty)
    {
            $all = Transit::paginate($qty);
            if($all->isEmpty()){
                return response()->json(['message' => 'No entries found in database'], 204);
            }
    
            return TransitResource::collection($all);  
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string',
            'from_city_id' => 'required|integer',
            'to_city_id' => 'required|integer',
            
            'routes.*' => 'integer'
        ]);


        // Validate if from city relationship actually exists in database.
        if(!City::find($request->from_city_id)){
            return response()->json(['error' => 'Can not add non existing relational City (id: '.$request->from_city_id.') to Transit.'], 422);
        }
 
        // Validate if to city relationship actually exists in database.
        if(!City::find($request->to_city_id)){
            return response()->json(['error' => 'Can not add non existing relational City (id: '.$request->to_city_id.') to Transit.'], 422);
        }

        // Validate if the relational routes actually exist in database.
        if($request->routes){
            foreach ($request->routes as $route_id) {
                if(!Route::find($route_id)){
                    return response()->json(['error' => 'Can not add non existing relational Route (id: '.$route_id.') to Transit.'], 422);
                }
            }
        }

        $transit = Transit::create([
            'name' => $request->name,
            'from_city_id' => $request->from_city_id,
            'to_city_id' => $request->to_city_id
        ]);

        // Add the relational routes to $transit
        if($request->routes){
            foreach ($request->routes as $route_id) {
                $transit->routes()->save(
                    Route::find($route_id)
                );
            }
        }

        return (new TransitResource($transit))
                                    ->response()
                                    ->setStatusCode(201);
    }
}
