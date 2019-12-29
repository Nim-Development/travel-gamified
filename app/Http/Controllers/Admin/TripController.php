<?php

namespace App\Http\Controllers\Admin;

use App\Trip;
use App\Http\Resources\Trip as TripResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TripController extends Controller
{
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = Trip::all(),
            TripResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        return new TripResource(Trip::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Trip::paginate($qty),
            TripResource::collection($all)
        );
    }
}
