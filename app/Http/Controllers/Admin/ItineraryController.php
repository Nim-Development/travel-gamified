<?php

namespace App\Http\Controllers\Admin;

use App\Tour;
use App\Itinerary;

use App\City;
use App\Route;
use App\Transit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Itinerary as ItineraryResource;


class ItineraryController extends Controller
{
    // Collection of all entries
    public function all()
    {       
        $all = Itinerary::all();       
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return ItineraryResource::collection($all);  

    }

    // Single entry by id
    public function single($id)
    {
        return new ItineraryResource(Itinerary::findOrFail($id));
    }

    public function paginate($qty)
    {
        $all = Itinerary::paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return ItineraryResource::collection($all);  
    }

    public function all_by_playfield($playfield_type)
    {
        $all = Itinerary::where('playfield_type', $playfield_type)->get();
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return ItineraryResource::collection($all);  
    }

    public function paginate_by_playfield($playfield_type, $qty)
    {
        $all = Itinerary::where('playfield_type', $playfield_type)->paginate($qty);
        if($all->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return ItineraryResource::collection($all);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'integer',
            'step' => 'required|integer',
            'duration' => 'required|numeric',
            'playfield_type' => 'string',
            'playfield_id' => 'integer'
        ]);

        if($request->playfield_type && $request->playfield_id){

            $playfield = \Playfields::find_morph_or_fail($request->playfield_type, $request->playfield_id);
            if(is_array($playfield)){
                return response()->json($playfield['message'], $playfield['status']);
            }

            if($request->tour_id){
                // check if relational tour actually exists in database
                if(!Tour::find($request->tour_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Itinerary for non existing Tour'], 422);
                }

                // Create Itinerary with playfield and tour
                $itinerary = Itinerary::create([
                    'tour_id' => $request->tour_id,
                    'step' => $request->step,
                    'duration' => $request->duration,
                    'playfield_type' => $request->playfield_type,
                    'playfield_id' => $request->playfield_id
                ]);
            }else{
                // Create Itinerary with playfield and without a tour
                $itinerary = Itinerary::create([
                    'tour_id' => null,
                    'step' => $request->step,
                    'duration' => $request->duration,
                    'playfield_type' => $request->playfield_type,
                    'playfield_id' => $request->playfield_id
                ]);
            }
        }else{
            if($request->tour_id){
                
                if(!Tour::find($request->tour_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Itinerary for non existing Tour'], 422);
                }

                // create Itinerary without playfield with tour
                $itinerary = Itinerary::create([
                    'tour_id' => $request->tour_id,
                    'step' => $request->step,
                    'duration' => $request->duration,
                    'playfield_type' => null,
                    'playfield_id' => null
                ]);
            }else{
                // create Itinerary without playfield and without tour
                $itinerary = Itinerary::create([
                    'tour_id' => null,
                    'step' => $request->step,
                    'duration' => $request->duration,
                    'playfield_type' => null,
                    'playfield_id' => null
                ]);
            }
        }

        // Return as resource
        return (new ItineraryResource($itinerary))
        ->response()
        ->setStatusCode(201);
        
    }


    public function update(Request $request, $id)
    {
        // Nothing required, just data types
        $request->validate([
            'tour_id' => 'integer',
            'step' => 'integer',
            'duration' => 'numeric',
            'playfield_type' => 'string',
            'playfield_id' => 'integer'
        ]);

        if($request->tour_id){
            if(!Tour::find($request->tour_id)){
                return response()->json(['error' => 'Can not create Itinerary for non existing Tour'], 422); 
            }
        }
        
        if($request->playfield_type && $request->playfield_id){
            // check if relational playfield row actually exists in database
            $playfield = \Playfields::find_morph_or_fail($request->playfield_type, $request->playfield_id);
            if(is_array($playfield)){
                return response()->json($playfield['message'], $playfield['status']);
            }
        }

        $itinerary = Itinerary::findOrFail($id);

        $itinerary->update($request->all());

        // Return as resource
        return (new ItineraryResource($itinerary))
            ->response()
            ->setStatusCode(200);
    }


    public function destroy($id)
    {
        $itinerary = Itinerary::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $itinerary->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
    
}
