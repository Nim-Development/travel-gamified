<?php

namespace App\Http\Controllers\Admin;

use App\Tour;
use App\Http\Resources\Tour as TourResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour as TourRequest;

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

    public function store(TourRequest $request)
    {
        $tour = Tour::create($request->validated());
        return (new TourResource($tour))->response()->setStatusCode(201);

    }
    
    public function update(TourRequest $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $tour->update($request->validated());

        // return Resource
        return (new TourResource($tour))->response()->setStatusCode(200);
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $tour->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
