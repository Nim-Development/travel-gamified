<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Tour as TourResource;
use App\Tour;
use App\Http\Resources\Dashboard\Itinerary as ItineraryResource;
use App\Http\Resources\Dashboard\Transit as TransitResource;
use App\City;
use App\Http\Resources\Dashboard\City as CityResource;
use App\Transit;
use App\Route;
use App\Http\Resources\Dashboard\Route as RouteResource;

class TourController extends Controller
{
    public function index(){
        $tours = Tour::all();
        return view('dashboard.game-development.tours', compact('tours'));
    }

    public function active()
    {
        //::NTS make proper status based query
        $tours = Tour::all();
        return view('dashboard.game-development.tours', compact('tours'));
    }

    public function inactive()
    {
        //::NTS make proper status based query
        $tours = Tour::all();
        return view('dashboard.game-development.tours', compact('tours'));
    }

    public function show($id)
    {
        $tourModel = Tour::findOrFail($id);

        // extract json responses from ApiResource
        $tour = (new TourResource($tourModel))->toResponse(app('request'))->getData();
        $itineraries = (ItineraryResource::collection($tourModel->itineraries))->toResponse(app('request'))->getData();

        $transits = (TransitResource::collection(Transit::all()))->toResponse(app('request'))->getData();
        $cities = (CityResource::collection(City::all()))->toResponse(app('request'))->getData();
        $routes = (RouteResource::collection(Route::all()))->toResponse(app('request'))->getData();

        return view('dashboard.game-development.tour', compact('tour', 'itineraries', 'transits', 'cities', 'routes'));
    }

}
