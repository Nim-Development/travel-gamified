<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Route;

use App\Transit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Transit as TransitResource;
use App\Http\Requests\Transit as TransitRequest;

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

    public function store(TransitRequest $request)
    {

        // // Validate if the relational routes actually exist in database.
        // if($request->routes){
        //     foreach ($request->routes as $route_id) {
        //         if(!Route::find($route_id)){
        //             return response()->json(['error' => 'Can not add non existing relational Route (id: '.$route_id.') to Transit.'], 422);
        //         }
        //     }
        // }

        $transit = Transit::create($request->validated());
        $transit->attach_routes($request->routes);

        return (new TransitResource($transit))
                                    ->response()
                                    ->setStatusCode(201);
    }

    public function update(TransitRequest $request, $id)
    {
        
        // find or fail with 422
        $transit = Transit::findOrFail($id);

        // perform update ( ::nk handle exception )
        $transit->update($request->validated());         

        // Add the relational routes to $transit
        $transit->attach_routes($request->routes);

        // Return as resource
        return (new TransitResource($transit))
            ->response()
            ->setStatusCode(200);
    }



    public function destroy($id)
    {
        $transit = Transit::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $transit->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }

}
