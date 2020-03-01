<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transit;
use App\Http\Resources\Dashboard\Transit as TransitResource;
use App\Route;
use App\Http\Resources\Dashboard\Route as RouteResource;
use App\City;
use App\Http\Resources\Dashboard\City as CityResource;

class TransitController extends Controller
{
    public function index()
    {
        $transits = Transit::all();
        return view('dashboard.game-development.transits', compact('transits'));
    }

    public function show($id)
    {
        $transit = (new TransitResource(Transit::find($id)))->toResponse(app('request'))->getData();
        $routes = (RouteResource::collection(Route::all()))->toResponse(app('request'))->getData();
        $cities = (CityResource::collection(Route::all()))->toResponse(app('request'))->getData();

        return view('dashboard.game-development.transit', compact('transit', 'routes', 'cities'));
    }

    public function new()
    {
        $routes = (RouteResource::collection(Route::all()))->toResponse(app('request'))->getData();
        $cities = (CityResource::collection(Route::all()))->toResponse(app('request'))->getData();

        return view('dashboard.game-development.new_transit', compact('routes', 'cities'));
    }
}
