<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\City as CityResource;
use App\City;
use App\Http\Requests\City as CityRequest;

class CityController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $all = City::all();
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return CityResource::collection($all);  
    }

    public function paginate($qty)
    {
        $all = City::paginate($qty);

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return CityResource::collection($all);  
    }

    // Single entry by id
    public function single($id)
    {
        $data = City::findOrFail($id);
        return new CityResource($data);
    }

    public function store(CityRequest $request)
    {
        //Create City
        $city = City::create($request->validated());
  
        $city->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        // Return resource
        return (new CityResource($city))->response()->setStatusCode(201);
    }


    public function update(CityRequest $request, $id)
    {
        
        // find or fail with 422
        $city = City::findOrFail($id);

        // perform update ( ::nk handle exception )
        $city->update($request->validated());

        $city->attach_media([
            'header' => $request->header,
            'media' => $request->media
        ]);

        // Return as resource
        return (new CityResource($city))->response()->setStatusCode(200);
    }


    public function destroy($id)
    {
        $city = City::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $city->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
