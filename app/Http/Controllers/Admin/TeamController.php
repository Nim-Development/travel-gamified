<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;

class TeamController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $data = Team::all();
        $code = 200;
        
        return response()->json($data, $code);
    }

    // Single entry by id
    public function single($id)
    {
        $data = Team::find($id);
        $code = 200;

        return response()->json($data, $code);
    }
}
