<?php

namespace App\Http\Controllers\Admin;

use App\Tour;
use App\Http\Resources\Tour as TourResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = Tour::all(),
            TourResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        return new TourResource(Tour::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Tour::paginate($qty),
            TourResource::collection($all)
        );
    }
}
