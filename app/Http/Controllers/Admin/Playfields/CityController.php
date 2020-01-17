<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Playfields\City as CityResource;
use App\Playfields\City;

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

    public function store(Request $request)
    {
        $request->validate([
            'short_code' => 'required|string',
            'name' => 'required|string'
        ]);

        // validate header file
        if($request->has('header')){
            // must be of type .jpg or .png
            $res = $request->validate([
                "header.*"  => "image",
            ]);
        }

        // validate media file
        if($request->has('media')){
            // must be of type .jpg or .png
            $res = $request->validate([
                "media.*"  => "image",
            ]);
        }

        //Create City
        $city = City::create([
            'short_code' => $request->short_code,
            'name' => $request->name
        ]);

        // validate header file
        if($request->has('header')){
            // insert the media file.
            \MediaHelper::model_insert(
                $city, // model
                $request->header, // media (single or array)
                'header' // collection name
            );
        }

        // validate header file
        if($request->has('media')){
            // insert the media file.
            \MediaHelper::model_insert(
                $city, // model
                $request->media, // media (single or array)
                'media' // collection name
            );
        }

        // Return resource
        return (new CityResource($city))
                                ->response()
                                ->setStatusCode(201);
    }


    public function update(Request $request, $id)
    {
        // Nothing required, just data types
        $request->validate([
            'short_code' => 'string',
            'name' => 'string'
        ]);
        
        // find or fail with 422
        $city = City::findOrFail($id);

        // perform update ( ::nk handle exception )
        $city->update($request->except(['header', 'media']));

        if($request->header){
            \MediaHelper::model_insert(
                $city, // model
                $request->header, // media (single or array)
                'header' // collection name
            );
        }

        if($request->media){
            \MediaHelper::model_insert(
                $city,
                $request->media,
                'media'
            );
        }

        // Return as resource
        return (new CityResource($city))
            ->response()
            ->setStatusCode(200);
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
