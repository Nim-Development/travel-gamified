<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Http\Resources\Team as TeamResource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    // Collection of all entries
    public function all()
    {
        return \Validate::collection(
            $all = Team::all(),
            TeamResource::collection($all)
        );
    }

    // Single entry by id
    public function single($id)
    {
        return new TeamResource(Team::findOrFail($id));
    }

    public function paginate($qty)
    {
        return \Validate::collection(
            $all = Team::paginate($qty),
            TeamResource::collection($all)
        );
    }
}
