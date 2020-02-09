<?php

namespace App\Http\Controllers\Admin;

use App\Route;
use App\Transit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Route as RouteResource;
use App\Http\Requests\Route as RouteRequest;

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


    public function store(RouteRequest $request)
    {
        //Create City
        $route = Route::create($request->validated());

        // Return resource
        return (new RouteResource($route))
                                ->response()
                                ->setStatusCode(201);
    }
    
    public function update(RouteRequest $request, $id)
    {
        // find or fail with 422
        $route = Route::findOrFail($id);
        // perform update ( ::nk handle exception )
        $route->update($request->validated());

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
