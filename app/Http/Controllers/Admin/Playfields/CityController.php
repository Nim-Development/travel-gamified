<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\Playfields\City as CityResource;
use App\Playfields\City;

class CityController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $data = City::all();
        return CityResource::collection($data);
    }

    public function paginate($qty)
    {
        $data = City::paginate($qty);
        return CityResource::collection($data);
    }

    // Single entry by id
    public function single($id)
    {
        $data = City::findOrFail($id);
        return new CityResource($data);
    }
}
