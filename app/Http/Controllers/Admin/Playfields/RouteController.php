<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Playfields\Route;

use App\Http\Controllers\Controller;
use App\Http\Resources\Playfields\Route as RouteResource;

class RouteController extends Controller
{
    // Single entry by id
    public function single($id)
    {
        return new RouteResource(Route::findOrFail($id));
    }
    
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = Route::all(),
            RouteResource::collection($all)
        );
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Route::paginate($qty),
            RouteResource::collection($all)
        );
    }
}
