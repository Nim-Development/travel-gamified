<?php

namespace App\Http\Controllers\Admin;

use App\Tour;
use App\Itinerary;

use App\Playfields\City;
use App\Playfields\Route;
use App\Playfields\Transit;
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
            // check if relational playfield row actually exists in database
            switch ($request->playfield_type) {

                case 'city':
                    if(!City::find($request->playfield_id)){
                        // Error: can't create answere for non existent challenge!
                        return response()->json(['error' => 'Can not create Itinerary for non existing City'], 422);
                    }
                    break;

                case 'route':
                    if(!Route::find($request->playfield_id)){
                        // Error: can't create answere for non existent challenge!
                        return response()->json(['error' => 'Can not create Itinerary for non existing Route'], 422);
                    }
                    break;

                case 'transit':
                    if(!Transit::find($request->playfield_id)){
                        // Error: can't create answere for non existent challenge!
                        return response()->json(['error' => 'Can not create Itinerary for non existing Transit'], 422);
                    }
                    break;
                
                default:
                    return response()->json(['error' => 'Playfield of type: '.$request->playfield_type.' does not exist.'], 400);
                    break;
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
    
}
