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
use App\Http\Requests\Itinerary as ItineraryRequest;


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

    public function store(ItineraryRequest $request)
    {
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

                // If tour already had itineraries, then make sure the sorting gets handled correctly.
                if(count(Tour::find($request->tour_id)->itineraries)){
                    if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
                        // also creat duration
                        $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
                        if($seconds == false){
                            $seconds = null;
                        }
                        $itinerary = Itinerary::create(array_merge($request->validated(), ["duration" => $seconds]));
                        // return response()->json($itinerary);
                        $itinerary->createAndSortPeers();
                    }else{
                        $itinerary = Itinerary::create($request->validated());
                        $itinerary->createAndSortPeers();
                    }
                }else{
                    // Create Itinerary with playfield and tour
                    if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
                        // also creat duration
                        $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
                        $itinerary = Itinerary::create(array_merge($request->validated(), ["duration" => $seconds]));
                    }else{
                        $itinerary = Itinerary::create($request->validated());
                    }
                }
            }else{
                
                // Create Itinerary with playfield and without a tour
                if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
                    // also creat duration
                    $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
                    $itinerary = Itinerary::create(array_merge($request->validated(), ["duration" => $seconds]));
                }else{
                    $itinerary = Itinerary::create($request->validated());
                }
            }
        }else{
            
            if($request->tour_id){
                if(!Tour::find($request->tour_id)){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Itinerary for non existing Tour'], 422);
                }

                // If tour already had itineraries, then make sure the sorting gets handled correctly.
                if(count(Tour::find($request->tour_id)->itineraries) > 0){
                    // Error: can't create answere for non existent challenge!
                    return response()->json(['error' => 'Can not create Itinerary for non existing Tour'], 422);
                }else{
                    if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
                        // also creat duration
                        $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
                        $itinerary = Itinerary::create(array_merge($request->validated(), ["duration" => $seconds]));
                        $itinerary->createAndSortPeers();
                    }else{
                        $itinerary = Itinerary::create($request->validated());
                        $itinerary->createAndSortPeers();
                    }
                }
            }else{
                
                // create Itinerary without playfield and without tour
                if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
                    // also creat duration
                    $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
                    $itinerary = Itinerary::create(array_merge($request->validated(), ["duration" => $seconds]));
                }else{
                    $itinerary = Itinerary::create($request->validated());
                }
            }
        }

        // Return as resource
        return (new ItineraryResource($itinerary))->response()->setStatusCode(201);
        
    }


    public function update(ItineraryRequest $request, $id)
    {
        if($request->playfield_type && $request->playfield_id){
            // check if relational playfield row actually exists in database
            $playfield = \Playfields::find_morph_or_fail($request->playfield_type, $request->playfield_id);
            if(is_array($playfield)){
                return response()->json($playfield['message'], $playfield['status']);
            }
        }

        if(array_key_exists("days",$request->validated()) && array_key_exists("hours",$request->validated()) && array_key_exists("minutes",$request->validated())){
            // also update time
            $seconds = \TimeConverter::dhmToSeconds($request->days, $request->hours, $request->minutes);
            $itinerary = Itinerary::findOrFail($id);
            $itinerary->update(array_merge($request->validated(), ['duration' => $seconds]));
        }else{
            $itinerary = Itinerary::findOrFail($id);
            $itinerary->update($request->validated());
        }

        // Return as resource
        return (new ItineraryResource($itinerary))->response()->setStatusCode(200);
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

    public function sort(ItineraryRequest $request, $id)
    {
        $tour = Tour::findOrFail($id);

        // Change the step values at id
        foreach ($request->sort_order as $idStep) {
            Itinerary::findOrFail($idStep['id'])->update(['step' => $idStep['step']]);
        }

        // return full collection of itineraries back to dashboard (Tour component)
        return (\App\Http\Resources\Dashboard\Itinerary::collection($tour->itineraries));
    }
    
}
