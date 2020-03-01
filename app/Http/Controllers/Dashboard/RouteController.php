<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Route;
use App\Http\Resources\Dashboard\Route as RouteResource;
use App\Transit;
use App\Http\Resources\Dashboard\Transit as TransitResource;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('dashboard.game-development.routes', compact('routes'));
    }

    public function show($id)
    {
        $route = (new RouteResource(Route::find($id)))->toResponse(app('request'))->getData();
        $transits = (TransitResource::collection(Transit::all()))->toResponse(app('request'))->getData();
        return view('dashboard.game-development.route', compact('route', 'transits'));
    }

    public function new()
    {
        $transits = (TransitResource::collection(Transit::all()))->toResponse(app('request'))->getData();
        return view('dashboard.game-development.new_route', compact('transits'));
    }
}
