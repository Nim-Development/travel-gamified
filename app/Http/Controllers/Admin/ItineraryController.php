<?php

namespace App\Http\Controllers\Admin;

use App\Itinerary;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\Itinerary as ItineraryResource;


class ItineraryController extends Controller
{
    // Collection of all entries
    public function all()
    {       
        return \Validate::collection(
            $all = Itinerary::all(),
            ItineraryResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        return new ItineraryResource(Itinerary::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Itinerary::paginate($qty),
            ItineraryResource::collection($all)
        );
    }

    public function all_by_playfield($playfield_type)
    {
        return \Validate::collection(
            $all = Itinerary::where('playfield_type', $playfield_type)->get(),
            ItineraryResource::collection($all)
        );
    }

    public function paginate_by_playfield($playfield_type, $qty)
    {
        return \Validate::collection(
            $all = Itinerary::where('playfield_type', $playfield_type)->paginate($qty),
            ItineraryResource::collection($all)
        );
    }
}
