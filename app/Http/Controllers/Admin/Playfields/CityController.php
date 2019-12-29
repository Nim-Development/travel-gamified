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
        return \Validate::collection(
            $all = City::all(),
            CityResource::collection($all)
        );
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = City::paginate($qty),
            CityResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        $data = City::findOrFail($id);
        return new CityResource($data);
    }
}
