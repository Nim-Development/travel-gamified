<?php

namespace App\Http\Controllers\Admin;

use App\Route;
use App\Transit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Route as RouteResource;

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
    
    public function update(Request $request, $id)
    {
        // Nothing required, just data types
        $request->validate([
            'transit_id' => 'numeric',
            'name' => 'string',
            'maps_url' => 'string',
            'kilometers' => 'numeric',
            'hours' => 'numeric',
            'difficulty' => 'numeric',
            'nature' => 'numeric',
            'highway' => 'integer'
        ]);
        
        // find or fail with 422
        $route = Route::findOrFail($id);

        // Check if relational transit_id actually exists in database
        if($request->transit_id){
            if(!Transit::find($request->transit_id)){
                return response()->json(['error' => 'Can not add a non existing Transit (id: '.$request->transit_id.') as relationship to Route.'] ,422);
            }
        }

        // perform update ( ::nk handle exception )
        $route->update($request->all());

        // Return as resource
        return (new RouteResource($route))
            ->response()
            ->setStatusCode(200);
    }


    public function destroy($id)
    {
        $route = Route::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $route->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }

}
