<?php

namespace App\Http\Controllers\Admin;

use App\Playfields\Route;
use App\Playfields\Transit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Playfields\Route as RouteResource;

class RouteController extends Controller
{
    // Single entry by id
    public function single($id)
    {
        return new RouteResource(Route::findOrFail($id));
    }
    
    // Collection of all entries
    public function all()
    {
        $all = Route::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return RouteResource::collection($all);  
    }

    public function paginate($qty)
    {
        $all = Route::paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return RouteResource::collection($all);  
    }


    public function store(Request $request)
    {
        $request->validate([
            'transit_id' => 'required|numeric',
            'name' => 'required|string',
            'maps_url' => 'required|string',
            'kilometers' => 'required|numeric',
            'hours' => 'required|numeric',
            'difficulty' => 'required|numeric',
            'nature' => 'required|numeric',
            'highway' => 'required|numeric'
        ]);

        // Check if relational transit_id actually exists in database
        if(!Transit::find($request->transit_id)){
            return response()->json(['error' => 'Can not add a non existing Transit (id: '.$request->transit_id.') as relationship to Route.'] ,422);
        }

        //Create City
        $route = Route::create([
            'transit_id' => $request->transit_id,
            'name' => $request->name,
            'maps_url' => $request->maps_url,
            'kilometers' => $request->kilometers,
            'hours' => $request->hours,
            'difficulty' => $request->difficulty,
            'nature' => $request->nature,
            'highway' => $request->highway
        ]);

        // Return resource
        return (new RouteResource($route))
                                ->response()
                                ->setStatusCode(201);
    }

}
