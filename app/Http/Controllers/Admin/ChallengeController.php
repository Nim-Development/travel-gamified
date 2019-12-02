<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Challenge;

class ChallengeController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $data = Challenge::all();
        $code = 200;
        
        return response()->json($data, $code);
    }

    // Single entry by id
    public function single($id)
    {
        $data = Challenge::find($id);
        $code = 200;

        return response()->json($data, $code);
    }
}
