<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Playfields\Transit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Playfields\Transit as TransitResource;

class TransitController extends Controller
{
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = Transit::all(),
            TransitResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        return new TransitResource(Transit::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Transit::paginate($qty),
            TransitResource::collection($all)
        );
    }
}
