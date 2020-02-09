<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\Trip;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Team as TeamResource;
use App\Http\Requests\Team as TeamRequest;

class TeamController extends Controller
{
    // Collection of all entries
    public function all()
    {
        $teams = Team::all();

        // valitdate if is empty
        if($teams->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }

        return TeamResource::collection($teams);
    }

    // Single entry by id
    public function single($id)
    {
        return new TeamResource(Team::findOrFail($id));
    }

    public function paginate($qty)
    {
        $teams = Team::paginate($qty);
        
        // valitdate if is empty
        if($teams->isEmpty()){
            return response()->json(['message' => 'No entries found in database'], 204);
        }
        
        return TeamResource::collection($teams);
    }

    public function store(TeamRequest $request)
    {
        $team = Team::create($request->validated());

        $team->attach_users($request->users);
        $team->attach_media(['badge' => $request->badge]);

        // Return resource
        return (new TeamResource($team))->response()->setStatusCode(201);
    }


    public function update(TeamRequest $request, $id)
    {
        $team = Team::findOrFail($id);

        $team->update($request->validated());
        $team->attach_users($request->users);
        $team->attach_media(['badge' => $request->badge]);

        // Return resource
        return (new TeamResource($team))->response()->setStatusCode(200);
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        try {
            // forceDelete makes sure the media will be deleted to.
            $team->forceDelete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
}
