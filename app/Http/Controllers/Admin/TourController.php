<?php

namespace App\Http\Controllers\Admin;

use App\Tour;
use App\Http\Resources\Tour as TourResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $all = Tour::all();

        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TourResource::collection($all);
    }

    // Single entry by id
    public function single($id)
    {
        return new TourResource(Tour::findOrFail($id));
    }

    public function paginate($qty)
    {
        $all = Tour::paginate($qty);
        
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TourResource::collection($all);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'duration' => 'required|numeric'
        ]);
        
        // create the tour
        $tour = Tour::create([
            'name' => $request->name,
            'duration' => $request->duration
        ]);

        // return Resource
        return (new TourResource($tour))
                                ->response()
                                ->setStatusCode(201);

    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'duration' => 'numeric'
        ]);
        
        $tour = Tour::findOrFail($id);

        $tour->update($request->all());

        // return Resource
        return (new TourResource($tour))
                                ->response()
                                ->setStatusCode(200);
    }
}
