<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\City;

class CityController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $data = City::all();
        $code = 200;
        
        return response()->json($data, $code);
    }

    // Single entry by id
    public function single($id)
    {
        $data = City::find($id);
        $code = 200;

        return response()->json($data, $code);
    }
}
